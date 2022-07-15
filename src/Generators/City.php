<?php

namespace PabloPETR\Generators;

use Faker\Factory;

class City extends Factory
{
    private $cities;
    private $state;

    public function __construct($state = null)
    {
        $this->state = $state;
        $citiesFile = file_get_contents('src/Generators/cities.json');

        $json = json_decode($citiesFile, true);
        $this->cities = (array)$json;
    }

    public function generate()
    {
        if(!$this->state) {
            $this->state = array_rand($this->cities);
        }

        $cityKey = array_rand(array_values($this->cities[$this->state]));

        return $this->cities[$this->state][$cityKey]['name'];
    }
}