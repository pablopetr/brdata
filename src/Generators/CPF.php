<?php

namespace PabloPETR\Generators;

use Faker\Factory;

class CPF extends Factory
{
    protected $faker;

    private $state;

    public const EMITTING_REGION =
    [
        "DF" => 1,
        "GO" => 1,
        "MS" => 1,
        "MT" => 1,
        "TO" => 1,
        "AC" => 2,
        "AM" => 2,
        "AP" => 2,
        "PA" => 2,
        "RO" => 2,
        "RR" => 2,
        "CE" => 3,
        "MA" => 3,
        "PI" => 3,
        "AL" => 4,
        "PB" => 4,
        "PE" => 4,
        "RN" => 4,
        "BA" => 5,
        "SE" => 5,
        "MG" => 6,
        "ES" => 7,
        "RJ" => 7,
        "SP" => 8,
        "PR" => 9,
        "SC" => 9,
        "RS" => 0,
    ];

    public function __construct($state = "RS")
    {
        $this->state = $state;
        $this->faker = Factory::create();
    }

    public function generate(): string
    {
        $cpf = $this->faker->regexify("\d{8}");
        $cpf .= (string)self::EMITTING_REGION[$this->state];
        $cpf .= $this->calculateCheckDigit($cpf);

        echo $cpf."\n\n\n";
        $cpf .= $this->calculateCheckDigit($cpf);


        return $cpf;
    }

    public function calculateCheckDigit($firstDigits): int
    {
        $numbers = str_split($firstDigits);
        $total = 0;
        foreach ($numbers as $index => $number) {
            $total += $index * $number;
        }

        return $total % 11 % 10;
    }
}
