<?php

namespace RomanNumerals;

class RomanNumerals
{
    protected static $lookup = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I'
    ];

    /**
     * @param $number
     * @return string
     */
    public function convert($number)
    {
        $roman = '';

        foreach (static::$lookup as $limit => $glyph) {
            while ($number >= $limit) {
                $roman .= $glyph;
                $number -= $limit;
            }
        }

        return $roman;
    }
}
