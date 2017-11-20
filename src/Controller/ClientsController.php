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

    public function add(Client $client, $airlines)
    {
        $stmt = $this->conn->prepare("INSERT INTO clients(name, country_id, forecast_stay) VALUES(?, ?, ?)");
        $stmt->bindParam(1, $client->getName());
        $stmt->bindParam(2, $client->getCountryId());
        $stmt->bindParam(3, $client->getForecastStay());
        if ($stmt->execute()) {
            $clientId = $this->conn->lastInsertId();

            foreach ($airlines as $airline) {
                $stmt = $this->conn->prepare("INSERT INTO clients_airlines(client_id, airline_id) VALUES(?, ?)");
                $stmt->bindParam(1, $clientId);
                $stmt->bindParam(2, $airline);
                $stmt->execute();
            }

            return true;
        } else {
            return false;
        }
    }

    public function search(Client $client)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM clients, countries WHERE clients.country_id = countries.id AND clients.name LIKE ?");
            $stmt->bindValue(1, '%'.$client->getName().'%');
            $stmt->execute();

            $clients = [];
            while ($c = $stmt->fetch()) {
                $clients[] = $c;
            }

            return $clients;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function view(Client $client)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM clients, countries WHERE clients.country_id = countries.id AND clients.id = ?");
            $stmt->bindValue(1, $client->getId());
            $stmt->execute();

            if ($stmt->rowCount() != 0) {
                $aux = $stmt->fetch();
                $client = new Client();
                $client->setName($aux[1]);
                $client->setCountryName($aux['name']);
                $client->setForecastStay($aux['forecast_stay']);

                return $client;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function edit(Client $client, $edit = false,  $airlines = null)
    {
        if ($edit) {
            try {
                $stmt = $this->conn->prepare("UPDATE clients SET name = ?, country_id = ?, forecast_stay = ? WHERE id = ?");
                $stmt->bindValue(1, $client->getName());
                $stmt->bindValue(2, $client->getCountryId());
                $stmt->bindValue(3, $client->getForecastStay());
                $stmt->bindValue(4, $client->getId());
                $stmt->execute();

                if ($this->saveClientAirlines($airlines, $client->getId())) {
                    return true;
                }

            } catch (PDOException $e) {
                return false;
            }
            return false;

        } else {
            try {
                $stmt = $this->conn->prepare("SELECT * FROM clients, countries WHERE clients.country_id = countries.id AND clients.id = ?");
                $stmt->bindValue(1, $client->getId());
                $stmt->execute();

                if ($stmt->rowCount() != 0) {
                    $aux = $stmt->fetch();
                    $client = new Client();
                    $client->setName($aux[1]);
                    $client->setCountryName($aux['name']);
                    $client->setCountryId($aux['country_id']);
                    $client->setForecastStay($aux['forecast_stay']);

                    return $client;
                } else {
                    return null;
                }
            } catch (PDOException $e) {
                return null;
            }
        }
    }

    private function saveClientAirlines($airlines, $client_id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM clients_airlines WHERE client_id = ?");
            $stmt->bindValue(1, $client_id);
            $stmt->execute();

            foreach ($airlines as $airline) {
                $stmt = $this->conn->prepare("INSERT INTO clients_airlines (client_id, airline_id) VALUES (?, ?);");
                $stmt->bindValue(1, $client_id);
                $stmt->bindValue(2, $airline);
                $stmt->execute();
            }
            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            if ($this->deleteCascadeClientsAirlines($id)) {
                $stmt = $this->conn->prepare("DELETE FROM clients WHERE id = ?");
                $stmt->bindValue(1, $id);
                $stmt->execute();
            }

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    private function deleteCascadeClientsAirlines($client_id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM clients_airlines WHERE client_id = ?");
            $stmt->bindValue(1, $client_id);
            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function redirect($url = '/trabalho-final-prog2')
    {
        header("Location: $url");
    }

}