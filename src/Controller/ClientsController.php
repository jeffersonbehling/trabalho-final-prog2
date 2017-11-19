<?php
include_once 'ConnectionController.php';

class ClientsController {

    private $conn;

    /**
     * ClientsController constructor.
     */
    public function __construct()
    {
        $this->conn = connect();
    }

    public function add (Client $client)
    {
        $stmt = $this->conn->prepare("INSERT INTO clients(name, country_id, forecast_stay) VALUES(?, ?, ?)");
        $stmt->bindParam(1, $client->getName());
        $stmt->bindParam(2, $client->getCountryId());
        $stmt->bindParam(3, $client->getForecastStay());
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}