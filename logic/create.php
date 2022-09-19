<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Добавите свою комп</title>
</head>

<body>
    <div class="wrapper">
        <form class="main form">
            <h1 class="main__title form__title">
                Добавить компанию
            </h1>
            <div class="form__inputs">
                <input class="input" type="text" placeholder="Название компании">
                <input class="input" type="text" placeholder="Сфера деятельности">
                <input class="input" type="text" placeholder="Адрес (перетащите маркер на карте)" readonly>
                <input class="input" type="tel" placeholder="Телефоны">
                <input class="input" type="text" placeholder="Website">
                <input class="input" type="email" placeholder="Email">
            </div>
            <button class="form__button button-circle">
                <svg width="2rem" height="2rem" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect y="7" width="16" height="2" fill="#6301a2" />
                    <rect x="7" width="2" height="16" fill="#6301a2" />
                </svg>
            </button>
        </form>
        <div class="map" id="map"></div>
    </div>
    <script defer src="./js/script.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>
    <script type="text/javascript">
        ymaps.ready(init);
        function init() {
            const myMap = new ymaps.Map("map", {
                center: [55.76, 37.64],
                zoom: 13
            }),
            myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                hintContent: 'Выберите',
            }, {
                iconLayout: 'default#image',
                iconImageHref: './img/map_icon.svg',
                iconImageSize: [32, 32],
                iconImageOffset: [-5, -38]
                mousemove: true
            });

            myMap.geoObjects
                .add(myPlacemark);
        }
    </script>
</body>

</html>