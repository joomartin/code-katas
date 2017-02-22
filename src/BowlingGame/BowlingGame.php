<?php

namespace BowlingGame;

use Doctrine\Instantiator\Exception\InvalidArgumentException;

class BowlingGame
{
    /**
     * @var array
     */
    protected $_rolls = [];

    /**
     * @param $pins
     */
    public function roll($pins)
    {
        $this->guardAgainstInvalidRoll($pins);
        $this->_rolls[] = $pins;
    }

    /**
     * @return int|mixed
     */
    public function score()
    {
        $score = 0;
        for ($roll = 0, $frame = 1; $frame <= 10; $frame++) {
            if ($this->isStrike($roll)) {
                $score += 10 + $this->strikeBonus($roll);
                $roll++;
                continue;

            }

            if ($this->isSpare($roll)) {
                $score += 10 + $this->spareBonus($roll);
            } else {
                $score += $this->getDefaultFrameScore($roll);
            }

            $roll += 2;
        }

        return $score;
    }

    /**
     * @param $roll
     * @return bool
     */
    private function isSpare($roll)
    {
        return $this->getDefaultFrameScore($roll) == 10;
    }

    /**
     * @param $roll
     * @return mixed
     */
    private function getDefaultFrameScore($roll)
    {
        return $this->_rolls[$roll] + $this->_rolls[$roll + 1];
    }

    /**
     * @param $roll
     * @return bool
     */
    private function isStrike($roll)
    {
        return $this->_rolls[$roll] == 10;
    }

    /**
     * @param $roll
     * @return mixed
     */
    private function strikeBonus($roll)
    {
        return $this->_rolls[$roll + 1] + $this->_rolls[$roll + 2];
    }

    /**
     * @param $roll
     * @return mixed
     */
    private function spareBonus($roll)
    {
        return $this->_rolls[$roll + 2];
    }

    /**
     * @param $pins
     */
    private function guardAgainstInvalidRoll($pins)
    {
        if ($pins < 0) {
            throw new InvalidArgumentException('Pins cannot be negative');
        }
    }
}
