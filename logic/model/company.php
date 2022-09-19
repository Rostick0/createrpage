<?

class Company {
    static public function get($name, $subcategory, $id) {
        global $database;

        $query = $database->query("SELECT * FROM `company` WHERE `name` LIKE '$name' AND  `subcategory` LIKE '$subcategory' AND `id` = '$id' LIMIT 1");
        return $query->fetch_assoc();
    }
}

?>