<?php
    function connect()
    {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=dbhotel", "root", "root");
            return $conn;

        } catch (ErrorException $e) {
            echo "Error Connect database: " . $e;
        }

        return null;

    }
?>