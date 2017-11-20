<?php
include_once 'ConnectionController.php';

class AirlinesController {

    private $conn;

    /**
     * CountriesController constructor.
     */
    public function __construct()
    {
        $this->conn = connect();
    }

    public function getAirlines()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM airlines ORDER BY name ASC");
            $stmt->execute();

            $airlines = [];
            while ($airline = $stmt->fetch()) {
                $airlines[] = $airline;
            }

            return $airlines;

        } catch (PDOException $e) {
            return null;
        }
    }

    public function getClientAirlines($client_id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM airlines, clients_airlines WHERE airline_id = id AND client_id = ?");
            $stmt->bindParam(1, $client_id);
            $stmt->execute();

            $airlines = [];
            while ($airline = $stmt->fetch()) {
                $airlines[] = $airline;
            }

            return $airlines;

        } catch (PDOException $e) {
            return null;
        }
    }

    public function getClientAirlinesId($client_id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT airline_id FROM clients_airlines WHERE client_id = ?");
            $stmt->bindParam(1, $client_id);
            $stmt->execute();

            $airlines = [];
            while ($airline = $stmt->fetch()) {
                $airlines[] = $airline['airline_id'];
            }

            return $airlines;

        } catch (PDOException $e) {
            return null;
        }
    }

    public function redirect($url = '/trabalho-final-prog2')
    {
        header("Location: $url");
    }

    public function search(Airline $airline)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM airlines WHERE airlines.name LIKE ?");
            $stmt->bindValue(1, '%'.$airline->getName().'%');
            $stmt->execute();

            $airlines = [];
            while ($airline = $stmt->fetch()) {
                $airlines[] = $airline;
            }

            return $airlines;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function edit(Airline $airline, $edit = false)
    {
        if ($edit) {
            try {
                $stmt = $this->conn->prepare("UPDATE airlines SET name = ? WHERE id = ?");
                $stmt->bindValue(1, $airline->getName());
                $stmt->bindValue(2, $airline->getId());
                $stmt->execute();

                return true;

            } catch (PDOException $e) {
                return false;
            }
            return false;

        } else {
            try {
                $stmt = $this->conn->prepare("SELECT * FROM airlines WHERE airlines.id = ?");
                $stmt->bindValue(1, $airline->getId());
                $stmt->execute();

                if ($stmt->rowCount() != 0) {
                    $aux = $stmt->fetch();
                    $airline = new Airline();
                    $airline->setName($aux['name']);

                    return $airline;
                } else {
                    return null;
                }
            } catch (PDOException $e) {
                return null;
            }
        }
    }

    public function view(Airline $airline)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM airlines WHERE airlines.id = ?");
            $stmt->bindValue(1, $airline->getId());
            $stmt->execute();

            if ($stmt->rowCount() != 0) {
                $aux = $stmt->fetch();
                $airline = new Airline();
                $airline->setName($aux['name']);

                return $airline;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function add(Airline $airline)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO airlines (name) VALUES (?)");
            $stmt->bindValue(1, $airline->getName());

            if ($stmt->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            return null;
        }
    }
}