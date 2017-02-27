<?php

namespace spec\BinarySearch;

use BinarySearch\BinarySearch;
use PhpSpec\ObjectBehavior;

class BinarySearchSpec extends ObjectBehavior
{
    // -------- search --------
    function it_should_return_negative_1_for_an_empty_array()
    {
        $this->search(1, [])->shouldEqual(-1);
    }

    function it_should_return_negative_1_for_non_existing_values()
    {
        $this->search(0, [1, 3, 5])->shouldEqual(-1);
        $this->search(2, [1, 3, 5])->shouldEqual(-1);
        $this->search(4, [1, 3, 5])->shouldEqual(-1);
        $this->search(6, [1, 3, 5])->shouldEqual(-1);
        $this->search(7, [1, 3, 5])->shouldEqual(-1);
        $this->search(8, [1, 3, 5])->shouldEqual(-1);
    }

    function it_searches_the_appropiate_index_for_an_existing_value()
    {
        $this->search(1, [1, 3, 5])->shouldEqual(0);
        $this->search(3, [1, 3, 5])->shouldEqual(1);
        $this->search(5, [1, 3, 5])->shouldEqual(2);

        $this->search(7, [1, 3, 5, 7, 8, 9])->shouldEqual(3);
        $this->search(8, [1, 3, 5, 7, 8, 9])->shouldEqual(4);
        $this->search(9, [1, 3, 5, 7, 8, 9])->shouldEqual(5);

        $this->search(13, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16])->shouldEqual(12);
    }

    // -------- half --------
    function it_calculates_the_half_of_two_indexes()
    {
        $this->half(0, 4)->shouldEqual(2);
        $this->half(1, 4)->shouldEqual(2);
        $this->half(2, 4)->shouldEqual(3);
    }
}
