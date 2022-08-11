<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Challenges\LatestDayInMonthFinder;

class LatestDayInMonthFinderTest extends TestCase
{
    private LatestDayInMonthFinder $unitUnderTest;

    public function setUp(): void
    {
        parent::setUp();

        $this->unitUnderTest = new LatestDayInMonthFinder();
    }

    public function test_it_returns_the_correct_day_of_month_and_week_for_august_2022()
    {
        /*
        
Q7. Write a function that receives a date in the format yy-dd-mm and returns an array
with the latest day of the month (number and day of the week) i.e. [31, "Sunday"];

         */
        $date = "22-10-08";

        $result = $this->unitUnderTest->__invoke($date);

        $this->assertEquals(31, $result[0], "First element should be the last day of august, which is 31");
        $this->assertEquals("Wednesday", $result[1], "The last day of August in 2022 is a Wednesday");
    }

    
    public function test_it_returns_the_correct_day_of_month_and_week_for_february_2024_leap_year()
    {
        $date = "24-02-02";

        $result = $this->unitUnderTest->__invoke($date);

        $this->assertEquals(29, $result[0], "First element should be the last day of February, which is 29 in a leap year");
        $this->assertEquals("Thursday", $result[1], "The last day of February in 2024 is a Thursday");
    }
}
