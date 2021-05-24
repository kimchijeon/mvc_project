<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dicehand.
 */
class DicehandTest extends TestCase
{
    /**
     * Construct object and verify that the object is of the correct class.
     */
    public function testCreateDicehandObject()
    {
        $diceHand = new Dicehand();
        $this->assertInstanceOf("\App\Dice\Dicehand", $diceHand);
    }

    /**
     * Construct object and verify that that getLastRoll() returns an array of
     * the correct number of dices.
     */
    public function testDicehandArrayDicesCount()
    {
        $diceHand = new Dicehand();

        $diceHand->setNumber(2);
        $diceHand->prepare();
        $diceHand->roll();

        $res = $diceHand->getLastRoll();
        $exp = 3;
        $this->assertCount($exp, $res);
    }

    /**
     * Construct object and verify that getLastRoll() returns an array of
     * integers.
     */
    public function testDicehandArrayIntegers()
    {
        $diceHand = new Dicehand();

        $diceHand->setNumber(2);
        $diceHand->prepare();
        $diceHand->roll();
        $res = $diceHand->getLastRoll();

        $this->assertContainsOnly('integer', $res);
    }

    /**
     * Construct object and verify that getLastRoll() returns an array of
     * integers between 1 and 6.
     */
    public function testDicehandArrayIntegerRange()
    {
        $diceHand = new Dicehand();

        $diceHand->setNumber(2);
        $diceHand->prepare();
        $diceHand->roll();
        $res = $diceHand->getLastRoll();

        $expLow = 1;
        $expHigh = 6;
        $this->assertGreaterThanOrEqual($expLow, $res[0]);
        $this->assertLessThanOrEqual($expHigh, $res[0]);

        $this->assertGreaterThanOrEqual($expLow, $res[1]);
        $this->assertLessThanOrEqual($expHigh, $res[1]);

        $this->assertGreaterThanOrEqual($expLow, $res[2]);
        $this->assertLessThanOrEqual($expHigh, $res[2]);
    }
}
