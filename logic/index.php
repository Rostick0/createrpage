<?
// название компании-род-деятельности
require_once 'require.php';

$company = Company::get(null, null, 1);

var_dump($company);

var_dump($_GET);

// echo mb_strtolower(removeComma(replaceSpaceDash($company['name'])));

// echo mb_strtolower(deleteStringAfterComma(replaceSpaceDash($company['subcategory'])));

// Website / Email

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="description" content="<?= $company['name'] ?>">
    <meta name="keywords" content="<?= $company['category'] ?>">
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
        <div class="map" id="map"></div>
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
                iconImageHref: './img/map_icon.svg',
                iconImageSize: [32, 32],
                iconImageOffset: [-5, -38]
            });

            myMap.geoObjects
                .add(myPlacemark);
        }
    </script>
</body>

</html>