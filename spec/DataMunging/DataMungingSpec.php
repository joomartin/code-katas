<?php

namespace spec\DataMunging;

use DataMunging\DataMunging;
use PhpSpec\ObjectBehavior;

class DataMungingSpec extends ObjectBehavior
{
    function it_fetches_minimum_temperatures_for_each_day_in_weather_file()
    {
        $this->weather('weather.dat')->shouldHaveCount(30);
        $this->weather('weather.dat')->shouldHaveKeyWithValue(0, [
            'Dy' => 1,
            'mnT' => 59 
        ]);

        $this->weather('weather.dat')->shouldHaveKeyWithValue(1, [
            'Dy' => 2,
            'mnT' => 63 
        ]);

        $this->weather('weather.dat')->shouldHaveKeyWithValue(29, [
            'Dy' => 30,
            'mnT' => 45 
        ]);
    }

    function it_fetches_team_name_with_smallest_goal_difference()
    {
        $this->football('football.dat')->shouldBe('Blackburn');
    }

    // -------- fetchFile --------
    function it_fetches_a_given_file()
    {
        $this->fetchFile('weather.dat')->shouldHaveCount(30);
        $this->fetchFile('football.dat')->shouldHaveCount(20);
    }

    function it_throws_an_exception_if_file_not_found()
    {
        $this->shouldThrow(new \InvalidArgumentException('File not found: nonexists.dat'))
            ->during('fetchFile', ['nonexists.dat']);
    }
}
