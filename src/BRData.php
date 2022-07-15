<?php

namespace PabloPETR;

use Faker\Factory;
use PabloPETR\Generators\CPF;

class BRData
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function cpf($separator = "-", $separator2 = "-", $state = "RS"): string
    {
        $generator = new CPF($state);
        $cpfDigits = $generator->generate();
        $parts = str_split($cpfDigits, 3);
        $cpf = implode($separator, array_slice($parts, 0, 3));
        $cpf .= $separator2.$parts[3];

        return $cpf;
    }
}
