<?

require_once './global/vars.php';

require_once './include/connect.php';

require_once './global/functions.php';

require_once './model/company.php';
require_once './controller/company.php';

switch ($uri) {
    case 'create':
        require_once './create.php';
        break;
    default:
        require_once './index.php';
}

?>