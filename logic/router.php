<?

$page_path = './page';

switch ($uri) {
    case '/create':
        $page_path .= '/create.php';
        break;
    case '/list':
        $page_path .= '/list.php';
        break;
    default:
        $page_path .= '/info.php';
}

require_once $page_path;

?>