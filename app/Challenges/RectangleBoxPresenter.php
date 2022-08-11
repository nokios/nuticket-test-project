<?php

namespace App\Challenges;

class RectangleBoxPresenter
{
    public function __invoke(string $sentence, string $char = "*"): string
    {

        /**
        * Write a simple function that takes a string and prints it’s words, one per line, in a rectangular frame.
        */

        $words = explode(" ", $sentence);

        $widestWord = 0;
        foreach ($words as $word) {
            $length = strlen($word);

            if ($length > $widestWord) {
                $widestWord = $length;
            }
        }

        // Pad the words to the right so that they produce a uniform width of strings
        foreach ($words as &$word) {
            $word = sprintf("%s %s %s", $char, str_pad($word, $widestWord), $char);
        }

        $horizontal = str_repeat($char, $widestWord + 4);

        array_unshift($words, $horizontal);
        array_push($words, $horizontal);

        return implode("\n", $words);
    }
}
