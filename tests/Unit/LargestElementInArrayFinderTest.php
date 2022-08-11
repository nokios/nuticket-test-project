<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Challenges\LargestElementInArrayFinder;

class LargestElementInArrayFinderTest extends TestCase
{
    private LargestElementInArrayFinder $unitUnderTest;

    public function setUp(): void
    {
        parent::setUp();

        $this->unitUnderTest = new LargestElementInArrayFinder();
    }

    public function test_it_returns_the_largest_integer()
    {
        $array = [34, 21, 0, 299, 2, 4];

        $result = $this->unitUnderTest->__invoke($array);

        $this->assertEquals(299, $result, "Expected result is incorrect");
        // Since this test prints output, no way to validate, for now. Could go through the trouble of capturing it..
    }

    public function test_it_returns_the_string_starting_with_the_latest_letter_in_the_alphabet_of_those_given()
    {
        $array = ["Apple", "Orange", "Apricot"];

        $result = $this->unitUnderTest->__invoke($array);

        $this->assertEquals("Orange", $result, "Expected result is incorrect");
        // Since this test prints output, no way to validate, for now. Could go through the trouble of capturing it..
    }
}
