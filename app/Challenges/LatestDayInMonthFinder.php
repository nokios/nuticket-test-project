<?php

namespace App\Challenges;

use DateTime;
use InvalidArgumentException;

class LatestDayInMonthFinder
{
    public function __invoke(string $date): array
    {
        /**
Q7. Write a function that receives a date in the format yy-dd-mm and returns an array
with the latest day of the month (number and day of the week) i.e. [31, "Sunday"];
         */
        $date = DateTime::createFromFormat('y-d-m', $date);

        if ($date === false) {
            throw new InvalidArgumentException("You must provide a date in the following format: yy-dd-mm");
        }

        $endOfMonth = DateTime::createFromFormat('y-d-m', $date->format('y-t-m'));

        var_dump($endOfMonth);

        return [
            $endOfMonth->format('d'),
            $endOfMonth->format('l')
        ];
    }
}
