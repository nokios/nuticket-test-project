<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Challenges\FibonacciSequenceGenerator;

class FibonacciSequenceGeneratorTest extends TestCase
{
    private FibonacciSequenceGenerator $unitUnderTest;

    public function setUp(): void
    {
        parent::setUp();

        $this->unitUnderTest = new FibonacciSequenceGenerator();
    }

    public function test_it_returns_the_correct_number_requested()
    {
        $result = $this->unitUnderTest->__invoke(2);

        $this->assertCount(2, $result, "Result did not return 2");
        $this->assertEquals(1, $result[0], "First number is not 1");
        $this->assertEquals(2, $result[1], "Second number is not 2");
    }

    public function test_it_returns_fifty_numbers()
    {
        $result = $this->unitUnderTest->__invoke(50);

        $this->assertCount(50, $result, "The result does not have expected 50 values");
        $this->assertEquals(196418, $result[25], "the middle result is wrong");
        $this->assertEquals(20365011074, $result[49], "The last result is not as expected");
    }
}
