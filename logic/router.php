<?

$page_path = './page';

switch ($uri) {
    case '/create':
        $page_path .= '/create.php';
        break;
    case '/list':
        $page_patj .= '/list.php';
    default:
        $page_path .= '/info.php';
}

require_once $page_path;

?>