<?

$database = new mysqli('localhost', 'root', '', 'company');

if (!$database) {
    die('Нет подключения к бд');
}

?>