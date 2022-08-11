<?php

namespace App\Challenges;

class LargestElementInArrayFinder
{
    public function __invoke(array $source)
    {
        /**
         * Q6. Write a function that returns the largest element in an array
         * When it comes to strings, no instruction given so Sort will use Alphabetical sorting (not size of string)
         * When it comes to arrays of objects... unknown
         */
        sort($source, SORT_NATURAL | SORT_FLAG_CASE);

        return end($source);
    }
}