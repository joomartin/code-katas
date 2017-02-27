<?php

namespace BinarySearch;

class BinarySearch
{
    /**
     * @param int $value 
     * @param array $array 
     * @return int
     */
    public function search($value, array $array)
    {
        return $this->searchBinary($value, $array, 0, count($array) - 1);
    }

    /**
     * @param int $value 
     * @param array $array 
     * @param int $left 
     * @param int $right 
     * @return int
     */
    protected function searchBinary($value, array $array, $left, $right)
    {
        if ($left > $right) 
            return -1;

        $half = $this->half($left, $right);

        if ($array[$half] < $value) {
            $half = $this->searchBinary($value, $array, $half + 1, $right);
        } elseif ($array[$half] > $value) {
            $half = $this->searchBinary($value, $array, $left, $half - 1);
        }

        return $half;
    }

    /**
     * @param int $left 
     * @param int $right 
     * @return int
     */
    public function half($left, $right)
    {
        return $left + intval(($right - $left) / 2);
    }
}
