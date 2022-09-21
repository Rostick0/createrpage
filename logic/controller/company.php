<?

class CompanyController {
    static public function create($name, $email, $phone, $website, $lon, $lat, $category) {
        $errors = false;

        if ($_SESSION['error_timeout_limit'] > $_SERVER['REQUEST_TIME']) {
            $_SESSION['error_timeout_limit'] = "Вы можете добавлять компанию 1 раз в течение 10 минут";
            return;
        } else {
            $_SESSION['error_timeout_limit'] = null;
        }
        
        if (strlen($name) < 3) {
            $_SESSION['name_error'] = "Название компании меньше 3 символов";

            $errors = true;
        }

        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['email_error'] = "Неправильная почта";

            $errors = true;
        }

        if (!$lon || !$lat) {
            $_SESSION['coords_error'] = "Не указаны координаты";
            $errors = true;
        }

        if (strlen($category) < 3) {
            $_SESSION['category_error'] = "Категория меньше 3 символов";
            $errors = true;
        }

        if ($errors) {
            return;
        }

        $query = Company::create($name, $email, $phone, $website, $lon, $lat, $category);

        if ($query) {
            $_SESSION['error_timeout_limit'] = $_SERVER['REQUEST_TIME'] + 600;
        }
    }

    static public function search($param, $limit, $offset) {
        $data = Company::search($param, $limit, $offset);

        if (!$data) {
            return null;
        }

        $result = [];

        foreach ($data as $value) {
            $result[] = $value;
        }

        return $result;
    }
}

?>