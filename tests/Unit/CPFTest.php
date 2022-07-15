<?php

namespace Test\Unit;

use PabloPETR\Generators\CPF;
use PHPUnit\Framework\TestCase;

class CPFTest extends TestCase
{
    private $generator;

    public function setUp(): void
    {
        parent::setUp();
        $this->generator = new CPF();
    }

    /** @test */
    public function it_should_generate_new_cpf_with_eleven_digits()
    {
        $cpf = $this->generator->generate();

        $this->assertTrue(strlen($cpf) === 11);
    }

    /** @test */
    public function it_should_generate_new_cpf_with_emitting_region_digit()
    {
        $generatorRS = new CPF("RS");
        $generatorSP = new CPF("SP");
        $generatorRJ = new CPF("RJ");

        $cpfWithRSEmittingDigit = $generatorRS->generate();
        $cpfWithSPEmittingDigit = $generatorSP->generate();
        $cpfWithRJEmittingDigit = $generatorRJ->generate();

        $this->assertTrue($cpfWithRSEmittingDigit[8] == $this->generator::EMITTING_REGION["RS"]);
        $this->assertTrue($cpfWithSPEmittingDigit[8] == $this->generator::EMITTING_REGION["SP"]);
        $this->assertTrue($cpfWithRJEmittingDigit[8] == $this->generator::EMITTING_REGION["RJ"]);
    }

    /** @test */
    public function it_should_generate_first_check_digit()
    {
        $digits = "01234567";
        $checkDigit = $this->generator->calculateCheckDigit($digits);

        $numbers = str_split($digits);
        $total = 0;
        foreach ($numbers as $index => $number) {
            $total += $index * $number;
        }

        $checkDigitCalculated = $total % 11 % 10;

        $this->assertTrue($checkDigit === $checkDigitCalculated);
    }

    /** @test */
    public function it_should_generate_second_check_digit()
    {
        $digits = "01234567";
        $digits .= $this->generator->calculateCheckDigit($digits);

        $secondCheckDigit = $this->generator->calculateCheckDigit($digits);

        $numbers = str_split($digits);
        $total = 0;
        foreach ($numbers as $index => $number) {
            $total += $index * $number;
        }

        $secondCheckDigitCalculated = $total % 11 % 10;

        $this->assertTrue($secondCheckDigit === $secondCheckDigitCalculated);
    }
}
