<?php

namespace Test\Unit;

use PabloPETR\Generators\State;
use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    private State $generator;

    private array $states = [
        'AC',
        'AL',
        'AP',
        'AM',
        'BA',
        'CE',
        'DF',
        'ES',
        'GO',
        'MA',
        'MT',
        'MS',
        'MG',
        'PA',
        'PB',
        'PR',
        'PE',
        'PI',
        'RJ',
        'RN',
        'RS',
        'RO',
        'RR',
        'SC',
        'SP',
        'SE',
        'TO',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->generator = new State();
        $this->states = array_values($this->states);
    }

    /** @test */
    public function it_should_generate_a_state()
    {
        $state = $this->generator->generate();

        $this->assertContains($state, $this->states);
    }

    /** @test */
    public function it_should_generate_a_state_as_string_type()
    {
        $state = $this->generator->generate();

        $this->assertIsString($state);
    }
}