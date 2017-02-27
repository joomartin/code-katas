<?php

namespace TennisGame;

class TennisGame
{
    /**
     * @var Player
     */
    private $player1;
    /**
     * @var Player
     */
    private $player2;

    /**
     * @var array
     */
    private $lookup = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty'
    ];

    /**
     * @param Player $player1
     * @param Player $player2
     */
    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    /**
     * @return string
     */
    public function score()
    {
        if ($this->hasAWinner()) {
            return "Win for {$this->leader()->name}";
        }

        if ($this->hasTheAdvantage()) {
            return "Advantage {$this->leader()->name}";
        }

        if ($this->inDeuce()) {
            return 'Deuce';
        }

        return $this->generalScore();
    }

    /**
     * @return bool
     */
    private function hasAWinner()
    {
        return ($this->hasEnoughPointsToBeWon()) && ($this->isLeadingByAtLeastTwo());
    }

    /**
     * @return bool
     */
    private function hasTheAdvantage()
    {
        return $this->hasEnoughPointsToBeWon() && $this->isLeadingByOne();
    }

    /**
     * @return bool
     */
    private function inDeuce()
    {
        return $this->player1->points + $this->player2->points >= 6 && $this->tied();
    }

    /**
     * @return string
     */
    private function generalScore()
    {
        $score = $this->lookup[$this->player1->points] . '-';
        $score .= $this->tied() ? 'All' : $this->lookup[$this->player2->points];

        return $score;
    }

    /**
     * @return bool
     */
    private function hasEnoughPointsToBeWon()
    {
        return max($this->player1->points, $this->player2->points) >= 4;
    }

    /**
     * @return bool
     */
    private function isLeadingByAtLeastTwo()
    {
        return abs($this->player1->points - $this->player2->points) >= 2;
    }

    /**
     * @return bool
     */
    private function isLeadingByOne()
    {
        return abs($this->player1->points - $this->player2->points) == 1;
    }

    /**
     * @return Player
     */
    private function leader()
    {
        return $this->player1->points > $this->player2->points
            ? $this->player1
            : $this->player2;
    }

    /**
     * @return bool
     */
    private function tied()
    {
        return $this->player1->points == $this->player2->points;
    }
}
