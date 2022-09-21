<?

$search = protectedData($_GET['search']);
$offset = (int) $_GET['offset'];
$limit = 20;

$company_list = CompanyController::search($search, $limit, $offset);

function normalizeForUrl($string)
{
    return mb_strtolower(replaceSpaceDash(removeComma($string)));
}

// var_dump($company_list);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Поиск компаний</title>
</head>

<body>
    <div class="wrapper">
        <div class="main list">
            <? if ($company_list) : ?>
                <ul class="list__company">
                    <? foreach ($company_list as $value) : ?>
                        <li class="list__company__item">
                            <a class="list__company_href" href="/<?= normalizeForUrl($value['name']) . "/" . str_replace([' /'], '', normalizeForUrl($value['subcategory'])) . "/{$value['id']}" ?>" rel="nofollow">
                                <h2 class="list__company_title">
                                    <?= $value['name'] ?>
                                </h2>
                                <h3 class="list__company_category">
                                    <?= str_replace([' /'], ',', $value['category']) ?>
                                </h3>
                            </a>
                        </li>
                    <? endforeach; ?>
                    <? if ($company_list[$limit - 1]) : ?>
                        <a class="list__company_more" href="/list?offset=<?= $offset += $limit ?>&search=<?= $search ?>">
                            Показать следующие
                        </a>
                    <? endif; ?>
                </ul>
            <? else : ?>
                <div class="list__company_none">
                    Компании не найдены
                </div>
            <? endif; ?>
        </div>
        <div class="map" id="map">
            <? require_once './components/search.php' ?>
        </div>
    </div>
    <? require_once './components/scripts.php' ?>
    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            const coordsArray = [<?
                                    if ($company_list) {
                                        foreach ($company_list as $value) {
                                            if ($value['lat'] && $value['lon']) {
                                                $data .= "{lat: {$value['lat']}, lon: {$value['lon']}, name: '{$value['name']}'},";
                                            }
                                        }

                                        echo mb_substr($data, 0, -1);
                                    }
                                    ?>];

            function getMaxNum(array, value) {
                let result = null;

                array.forEach(elem => {
                    if (!result) {
                        result = elem[value]
                        return;
                    }

                    if (result < elem[value]) {
                        result = elem[value];
                    }
                })

                return result;
            }

            function getMinNum(array, value) {
                let result = null;

                array.forEach(elem => {
                    if (!result) {
                        result = elem[value]
                        return;
                    }

                    if (result > elem[value]) {
                        result = elem[value];
                    }
                })

                return result;
            }

            const minLat = getMinNum(coordsArray, 'lat');
            const maxLon = getMaxNum(coordsArray, 'lon');

            const myMap = new ymaps.Map("map", {
                center: [minLat, maxLon],
                zoom: 7
            });

            // min lat max lon

            coordsArray.forEach(coord => {
                const placemark = new ymaps.Placemark([coord.lat, coord.lon], {
                    hintContent: 'Организация',
                    balloonContent: coord?.name
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: '/img/map_icon.svg',
                    iconImageSize: [32, 32],
                    iconImageOffset: [-5, -38]
                })
                myMap.geoObjects
                    .add(placemark)
            });

            // const myPlacemark = new ymaps.Placemark([1, 1], {
            //     hintContent: 'Организация',
            //     balloonContent: ''
            // }, {
            //     iconLayout: 'default#image',
            //     iconImageHref: '/img/map_icon.svg',
            //     iconImageSize: [32, 32],
            //     iconImageOffset: [-5, -38]
            // })
        }
    </script>
</body>

</html>