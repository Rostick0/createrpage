<?

$company_name = protectedData($_REQUEST['company_name']);
$category = protectedData($_REQUEST['category']);
$coords = protectedData($_REQUEST['coords']);
$telephone = protectedData($_REQUEST['telephone']);
$website = protectedData($_REQUEST['website']);
$email = protectedData($_REQUEST['email']);

$company_create = $_REQUEST['company_create'];

if (isset($company_create)) {
    $coords_explode = explode(',', $coords);
    $lat = trim($coords_explode[0]);
    $lon = trim($coords_explode[1]);
    CompanyController::create($company_name, $email, $phone, $website, $lon, $lat, $category);
}

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
                <? if ($_SESSION['error_timeout_limit']): ?>
                    <p class="text-error"><?= $_SESSION['error_timeout_limit'] ?></p>                    
                <? endif; ?>
                
                <? if (isset($company_create) && $_SESSION['name_error']): ?>
                    <input class="input _error" type="text" placeholder="Название компании" name="company_name">
                    <p class="text-error"><?= $_SESSION['name_error'] ?></p>
                    <? $_SESSION['name_error'] = null ?>
                <? else: ?>
                    <input class="input" type="text" placeholder="Название компании" name="company_name">
                <? endif; ?>

                <? if (isset($company_create) && $_SESSION['category_error']): ?>
                    <input class="input _error" type="text" placeholder="Сфера деятельности" name="category">
                    <p class="text-error"><?= $_SESSION['category_error'] ?></p>
                    <? $_SESSION['category_error'] = null ?>
                <? else: ?>
                    <input class="input" type="text" placeholder="Сфера деятельности" name="category">
                <? endif; ?>

                <? if (isset($company_create) && $_SESSION['coords_error']): ?>
                    <input class="input _error" type="text" placeholder="Адрес (перетащите маркер на карте)" name="coords" readonly>
                    <p class="text-error"><?= $_SESSION['coords_error'] ?></p>
                    <? $_SESSION['coords_error'] = null; ?>
                <? else: ?>
                    <input class="input" type="text" placeholder="Адрес (перетащите маркер на карте)" name="coords" readonly>
                <? endif; ?>

                <input class="input" type="tel" placeholder="Телефоны (через запятую)" name="telephone">
                <input class="input" type="text" placeholder="Website" name="website">
                
                <? if (isset($company_create) && $_SESSION['email_error']): ?>
                    <input class="input _error" type="email" placeholder="Email" name="email">
                    <p class="text-error"><?= $_SESSION['email_error'] ?></p>
                    <? $_SESSION['email_error'] = null ?>
                <? else: ?>
                    <input class="input" type="email" placeholder="Email" name="email">
                <? endif; ?>
            </div>
            <button class="form__button button-circle" name="company_create">
                <svg width="2rem" height="2rem" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect y="7" width="16" height="2" fill="#6301a2" />
                    <rect x="7" width="2" height="16" fill="#6301a2" />
                </svg>
            </button>
        </form>
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
                inputCoords.value = coord[0].toString().slice(0, 5) + ', ' + coord[1].toString().slice(0, 5);
            });

            return myMap.geoObjects
                .add(myPlacemark);
        }
    </script>
</body>

</html>