<?

class Company {
    static public function get($name, $subcategory, $id) {
        global $database;

        $query = $database->query("SELECT * FROM `company` WHERE `name` LIKE '$name' AND  `subcategory` LIKE '$subcategory' AND `id` = '$id' LIMIT 1");
        return $query->fetch_assoc();
    }

    static public function create($name, $email, $phone, $website,$lon, $lat, $category) {
        global $database;

        return $database->query("INSERT INTO `company`(`name`, `phone`, `email`, `website`, `lon`, `lat`, `category`, `subcategory`) VALUES ('$name','$phone','$email','$website','$lon','$lat','$category','$category')");
    }
    
    static public function search($param, $limit, $offset) {
        global $database;
        
        if ($limit) {
            $limit = "LIMIT $limit";

            if ($offset) {
                $limit .= ", $offset";
            }
        } else {
            $limit = null;
        }
        return $database->query("SELECT * FROM `company` WHERE `name` LIKE '%{$param}%' UNION SELECT * FROM `company` WHERE `category` LIKE '%{$param}%' UNION SELECT * FROM `company` WHERE `subcategory` LIKE '%{$param}%' $limit");
    }
}

?>