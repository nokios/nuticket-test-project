<?php

namespace App\Challenges;

class FibonacciSequenceGenerator
{
    public function __invoke(int $limit = 50): array
    {
        $out = [1];

        while (count($out) < $limit) {
            if (count($out) == 1) {
                $previousNumbers = [1, 1];
            } else {
                $previousNumbers = array_slice($out, -2, 2);
            }

            $out[] = array_sum($previousNumbers);
        }

        return $out;
    }
}
