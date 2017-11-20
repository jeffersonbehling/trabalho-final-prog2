<?php
include_once 'ConnectionController.php';

class CountriesController {

    private $conn;

    /**
     * CountriesController constructor.
     */
    public function __construct()
    {
        $this->conn = connect();
    }

    public function getCountries()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM countries ORDER BY name ASC");
            $stmt->execute();

            $countries = [];
            while ($country = $stmt->fetch()) {
                $countries[] = $country;
            }

            return $countries;

        } catch (PDOException $e) {
            return null;
        }
    }
}