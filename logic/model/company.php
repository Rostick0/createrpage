<?

class Company {
    static public function get() {
        global $database;

        $query = $database->query("SELECT * FROM `company` LIMIT 3, 1");
        return $query->fetch_assoc();
    }
}

?>