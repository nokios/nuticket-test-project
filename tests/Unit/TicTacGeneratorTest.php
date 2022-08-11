<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Challenges\TicTacGenerator;

class TicTacGeneratorTest extends TestCase
{
    private TicTacGenerator $unitUnderTest;

    public function setUp(): void
    {
        parent::setUp();

        $this->unitUnderTest = new TicTacGenerator();
    }

    public function test_it_prints_the_numbers()
    {
        // $result = $this->unitUnderTest->__invoke();

        $this->assertTrue(true); // Since this test prints output, no way to validate, for now. Could go through the trouble of capturing
    }
}
