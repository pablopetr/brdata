<?php

namespace Test\Unit;

use PabloPETR\Generators\City;
use PHPUnit\Framework\TestCase;

class CityTest extends TestCase
{
    private City $generator;

    private array $citiesStates;

    private array $cities;

    public function setUp(): void
    {
        parent::setUp();

        $this->generator = new City();
        $file = file_get_contents("src/Generators/cities.json");

        $json = json_decode($file, true);
        $this->citiesStates = (array)$json;
        $this->cities =  $this->getArrayValues($this->citiesStates);
    }

    public function getArrayValues(array $array): array
    {
        $values = [];
        foreach ($array as $value) {
            if (is_array($value)) {
                $values = array_merge($values, $this->getArrayValues($value));
            } else {
                $values[] = $value;
            }
        }

        return $values;
    }

    /** @test */
    public function it_should_generate_a_city()
    {
        $city = $this->generator->generate();

        $this->assertNotEmpty($city);
        $this->assertContains($city, $this->cities);
    }

    /** @test */
    public function it_should_generate_a_city_as_string_type()
    {
        $city = $this->generator->generate();

        $this->assertIsString($city);
    }

    /** @test */
    public function it_should_generate_city_related_to_a_state()
    {
        $state = array_rand($this->citiesStates);
        $generator = new City($state);

        $city = $generator->generate();
        $cities = $this->getArrayValues($this->citiesStates);

        $this->assertContains($city, $cities);
    }
}
