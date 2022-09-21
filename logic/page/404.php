<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Страницы не существует</title>
</head>

<body>
    <div class="wrapper">
        <div class="main page-404">
            <div class="main__title page-404__title">
                Ошибка 404
            </div>
            <div class="page-404__subtitle">
                Компания не добавлена или не существует
            </div>
        </div>
        <div class="map" id="map">
            <? require_once './components/search.php' ?>
        </div>
    </div>
    <? require_once './components/scripts.php' ?>
    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            const myMap = new ymaps.Map("map", {
                    center: [55.752, 37.615],
                    zoom: 13
                });

            return myMap.geoObjects;
        }
    </script>
</body>

</html>