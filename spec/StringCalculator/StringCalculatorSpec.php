<?php

namespace spec\StringCalculator;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class StringCalculatorSpec extends ObjectBehavior
{
    function it_translates_an_empty_string_into_zero()
    {
        $this->add('')->shouldEqual(0);
    }

    function it_find_the_sum_of_one_number()
    {
        $this->add('5')->shouldEqual(5);
    }

    function it_find_the_sum_of_two_number()
    {
        $this->add('1,2')->shouldEqual(3);
    }

    function it_find_the_sum_of_any_amount_of_number()
    {
        $this->add('1,2,3,4,5')->shouldEqual(15);
        $this->add('10,21,3,4,9')->shouldEqual(47);
    }

    function it_disallows_negative_numbers()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid number provided: -2'))->during('add', ['3, -2']);
    }

    function it_ignores_any_number_greater_or_equal_one_thousand()
    {
        $this->add('2,2,1000')->shouldEqual(4);
    }

    function it_allows_for_new_line_delimiters()
    {
        $this->add('2,2\n2')->shouldEqual(6);
    }

}
