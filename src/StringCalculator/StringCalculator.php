<?php

namespace StringCalculator;

use Doctrine\Instantiator\Exception\InvalidArgumentException;

class StringCalculator
{
    const MAX_NUMBER_ALLOWED = 1000;

    public function add($numbers)
    {
        $result = 0;
        $numbers = $this->parseNumbers($numbers);

        foreach ($numbers as $number) {
            $this->guardAgainInvalidNumber($number);
            if ($number >= self::MAX_NUMBER_ALLOWED) continue;

            $result += $number;
        }

        return $result;
    }

    /**
     * @param $number
     */
    private function guardAgainInvalidNumber($number)
    {
        if ($number < 0) {
            throw new InvalidArgumentException("Invalid number provided: {$number}");
        }
    }

    /**
     * @param $numbers
     * @return array
     */
    private function parseNumbers($numbers)
    {
        return array_map('intval', preg_split('/\s*(,|\\\n)\s*/', $numbers));
    }
}
