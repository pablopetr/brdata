<?php

namespace PabloPETR\Generators;

use Faker\Factory;

class State extends Factory
{
    private $states;

    public function __construct()
    {
        $stateFiles = file_get_contents("src/Generators/cities.json");

        $json = json_decode($stateFiles, true);
        $this->states = (array)$json;
    }

    public function generate()
    {
        return array_rand($this->states);
    }
}