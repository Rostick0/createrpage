<?

class Company {
    static public function get($name, $subcategory, $id) {
        global $database;

        $query = $database->query("SELECT * FROM `company` WHERE `name` LIKE '$name' AND  `subcategory` LIKE '$subcategory' AND `id` = '$id' LIMIT 1");
        return $query->fetch_assoc();
    }

    static public function create() {
        global $database;

        return $database->query("INSERT INTO `company`(`id`, `name`, `city_name`, `geometry_name`, `post_code`, `phone`, `email`, `website`, `vkontakte`, `instagram`, `lon`, `lat`, `category`, `subcategory`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]','[value-14]')");
    }
}

?>