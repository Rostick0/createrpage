<?

$name = str_replace(['-'], '%', urldecode(addslashes($segments[0])));
$subcategory = str_replace(['-'], '%', urldecode(addslashes($segments[1])));
$id = (int) $segments[2];

$company = Company::get($name, $subcategory, $id);

if (!$company) {
    require_once __DIR__ . './404.php';
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <meta name="description" content="<?= $company['name'] ?>">
    <meta name="keywords" content="<?= str_replace([' /'], ',', $company['category']) ?>">
    <title><?= $company['name'] ?></title>
</head>

<body>
    <div class="wrapper">
        <div class="main info">
            <? if ($company['name']) : ?>
                <h1 class="main__title info__title">
                    <?= $company['name'] ?>
                </h1>
            <? endif; ?>
            <? if ($company['subcategory']) : ?>
                <h2 class="info__subtitle">
                    <?= $company['subcategory'] ?>
                </h2>
            <? endif; ?>
            <div class="info__video">

            </div>
            <ul class="info__list">
                <? if ($company['geometry_name']) : ?>
                    <li class="info__item">
                        <div class="info__item_title">
                            Адрес:
                        </div>
                        <div class="info__item_data">
                            <?= $company['geometry_name'] ?>
                        </div>
                    </li>
                <? endif; ?>
                <? if ($company['phone']) : ?>
                    <li class="info__item">
                        <div class="info__item_title">
                            Телефон
                        </div>
                        <div class="info__item_data">
                            <?= replaceCommaDiv($company['phone']) ?>
                        </div>
                    </li>
                <? endif; ?>
                <? if ($company['website'] || $company['email']) : ?>
                    <li class="info__item">
                        <div class="info__item_title">
                            <?= websiteAndEmail($company['website'], $company['email']) ?>
                        </div>
                        <? if ($company['website']) : ?>
                            <div class="info__item_data">
                                <?= $company['website'] ?>
                            </div>
                        <? endif; ?>
                        <? if ($company['email']) : ?>
                            <div class="info__item_data">
                                <?= $company['email'] ?>
                            </div>
                        <? endif; ?>
                    </li>
                <? endif; ?>
            </ul>
        </div>
        <div class="map" id="map">
            <div class="search">
                <input type="text" class="search__input input" placeholder="Поиск компании по сайту">
                <div class="search__buttons">
                    <button class="search__button button-circle">
                        <svg width="2rem" height="2rem" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="9.5" stroke="#fff" stroke-width="3" />
                            <rect x="17" y="19.1213" width="3" height="15" transform="rotate(-45 17 19.1213)" fill="#fff" />
                        </svg>
                    </button>
                    <a class="button-circle" href="/create">
                        <svg width="2rem" height="2rem" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect y="7" width="16" height="2" fill="#fff"></rect>
                            <rect x="7" width="2" height="16" fill="#fff"></rect>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <? require_once './components/scripts.php' ?>
    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            const myMap = new ymaps.Map("map", {
                    center: [<?= $company['lat'] ?>, <?= $company['lon'] ?>],
                    zoom: 13
                }),
                myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                    hintContent: 'Организация',
                    balloonContent: '<?= $company['name'] ?>'
                }, {
                    iconLayout: 'default#image',
                    iconImageHref: '/img/map_icon.svg',
                    iconImageSize: [32, 32],
                    iconImageOffset: [-5, -38]
                });

            myMap.geoObjects
                .add(myPlacemark);
        }
    </script>
</body>

</html>