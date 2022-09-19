<?

$database = new mysqli('localhost', 'root', 'root', 'company');

if (!$database) {
    die('Нет подключения к бд');
}

?>