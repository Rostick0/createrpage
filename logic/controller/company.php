<?

class CompanyController {
    static public function create($name, $email, $phone, $website, $lon, $lat, $category) {


        Company::create($name, $email, $phone, $website, $lon, $lat, $category);
    }
}

?>