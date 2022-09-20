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
            <div class="search">
                <input type="text" class="search__input input" placeholder="Поиск компании по сайту">
                <form class="search__buttons" method="POST">
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
                </form>
            </div>
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