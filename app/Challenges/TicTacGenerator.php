<?php

namespace App\Challenges;

class TicTacGenerator
{
    public function __invoke(int $start = 1, int $end = 100): void
    {
        /**
         * Q5. Write a program that prints the numbers from 1 to 100. But for multiples of three print "Tic" instead of 
         * the number and for the multiples of five print "Tac". For numbers which are multiples of both three and five print "TicTac".
         */

         for ($i = $start; $i <= $end; $i++) {
            $multipleOf3 = ($i % 3) == 0;
            $multipleOf5 = ($i % 5) == 0;

            if ($multipleOf3 && ! $multipleOf5) {
                echo "Tic";
            } elseif (! $multipleOf3 && $multipleOf5) {
                echo "Tac";
            } elseif ($multipleOf3 && $multipleOf5) {
                echo "TicTac";
            } else {
                echo $i;
            }
            echo "\n";
         }


    }
}
