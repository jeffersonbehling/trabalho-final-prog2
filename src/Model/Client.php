<?php

class Client {
    private $id;
    private $name;
    private $country_id;
    private $forecast_stay;

    /**
     * Client constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * @param mixed $country_id
     */
    public function setCountryId($country_id)
    {
        $this->country_id = $country_id;
    }

    /**
     * @return mixed
     */
    public function getForecastStay()
    {
        return $this->forecast_stay;
    }

    /**
     * @param mixed $forecast_stay
     */
    public function setForecastStay($forecast_stay)
    {
        $this->forecast_stay = $forecast_stay;
    }
}