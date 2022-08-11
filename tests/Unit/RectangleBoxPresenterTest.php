<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Challenges\RectangleBoxPresenter;

use function PHPUnit\Framework\assertEquals;

class RectangleBoxPresenterTest extends TestCase
{
    private RectangleBoxPresenter $unitUnderTest;

    public function setUp(): void
    {
        parent::setUp();

        $this->unitUnderTest = new RectangleBoxPresenter();
    }

    public function test_it_prints_the_sentence_in_a_rectangle()
    {
        $sentence = "Good luck with the test";

        // In php 7.3+, heredoc strings can align like below, and there will be no leading whitespace interpeted.
        // This allows us to avoid the awkwardness of having to de-indent the string
        $expectedResult = <<<EOD
        ********
        * Good *
        * luck *
        * with *
        * the  *
        * test *
        ********
        EOD;

        $result = $this->unitUnderTest->__invoke($sentence);

        $this->assertEquals($expectedResult, $result, "The result is incorrect");
    }

    public function test_it_prints_the_sentence_in_a_rectangle_with_a_wide_word()
    {
        $sentence = "Working in tech in Pennsylvania is interesting";

        // In php 7.3+, heredoc strings can align like below, and there will be no leading whitespace interpeted.
        // This allows us to avoid the awkwardness of having to de-indent the string
        $expectedResult = <<<EOD
        ****************
        * Working      *
        * in           *
        * tech         *
        * in           *
        * Pennsylvania *
        * is           *
        * interesting  *
        ****************
        EOD;

        $result = $this->unitUnderTest->__invoke($sentence);

        $this->assertEquals($expectedResult, $result, "The result is incorrect");
    }
}
