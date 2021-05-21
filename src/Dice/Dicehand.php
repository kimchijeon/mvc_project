<?php

declare(strict_types=1);

namespace App\Dice;

/**
 * Class Dicehand.
 */
class Dicehand
{
    private $dices;
    private int $number;

    /**
     * Set the number of dice.
     *
     * @param int $number The number of dice.
     *
     * @return void
     */
    public function setNumber(int $number)
    {
        $this->number = $number;
    }

    public function prepare()
    {
        if (isset($this->number)) {
            for ($i = 0; $i <= $this->number; $i++) {
                $this->dices[$i] = new Dice();
            }
        }
    }

    public function roll(): void
    {
        if (isset($this->number)) {
            for ($i = 0; $i <= $this->number; $i++) {
                $this->dices[$i]->roll();
            }
        }
    }

    public function getLastRoll(): array
    {
        $res = "";

        if (isset($this->number)) {
            for ($i = 0; $i <= $this->number; $i++) {
                $res .= $this->dices[$i]->getLastRoll() . ",";
            }
        }

        $resArray = array_map('intval', explode(",", rtrim($res, ',')));
        return $resArray;
    }
}
