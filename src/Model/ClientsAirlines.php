<?php

class ClientsAirlines {
    private $client_id;
    private $airline_id;

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    public function getAirlineId()
    {
        return $this->airline_id;
    }

    /**
     * @param mixed $airline_id
     */
    public function setAirlineId($airline_id)
    {
        $this->airline_id = $airline_id;
    }
}

?>