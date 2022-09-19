<?

$company_name = protectedData($_REQUEST['company_name']);
$category = protectedData($_REQUEST['category']);
$coords = protectedData($_REQUEST['coords']);
$telephone = protectedData($_REQUEST['telephone']);
$website = protectedData($_REQUEST['website']);
$email = protectedData($_REQUEST['email']);

$company_create = $_REQUEST['company_create'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Добавите свою компанию</title>
</head>

<body>
    <div class="wrapper">
        <form class="main form" method="POST">
            <h1 class="main__title form__title">
                Добавить компанию
            </h1>
            <div class="form__inputs">
                <input class="input" type="text" placeholder="Название компании" name="company_name">
                <input class="input" type="text" placeholder="Сфера деятельности" name="category">
                <input class="input" type="text" placeholder="Адрес (перетащите маркер на карте)" name="coords" readonly>
                <input class="input" type="tel" placeholder="Телефоны (через запятую)" name="telephone">
                <input class="input" type="text" placeholder="Website" name="website">
                <input class="input" type="email" placeholder="Email" name="email">
            </div>
            <button class="form__button button-circle" name="company_create">
                <svg width="2rem" height="2rem" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect y="7" width="16" height="2" fill="#6301a2" />
                    <rect x="7" width="2" height="16" fill="#6301a2" />
                </svg>
            </button>
        </form>
        <div class="map" id="map"></div>
    </div>
    <? require_once './components/scripts.php' ?>
    <script type="text/javascript">
        const inputCoords = document.getElementsByName("coords")[0];

        ymaps.ready(init);

        function init() {
            const myMap = new ymaps.Map("map", {
                    center: [55.752, 37.615],
                    zoom: 13,
                    controls: ['geolocationControl']
                }),
            myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                hintContent: 'Организация',
            }, {
                iconLayout: 'default#image',
                iconImageHref: '/img/map_icon.svg',
                iconImageSize: [32, 32],
                iconImageOffset: [-5, -38],
			    draggable: true
            });

            myPlacemark.events.add('dragend', function(e){
			const coord = e.get('target').geometry.getCoordinates();
                console.log(coord);
                inputCoords.value = coord[0].toString().slice(0, 5) + ', ' + coord[1].toString().slice(0, 5);
            });

            return myMap.geoObjects
                .add(myPlacemark);
        }
    </script>
</body>

</html>