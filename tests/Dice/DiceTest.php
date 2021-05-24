<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object is of the correct class.
     */
    public function testCreateDiceObject()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\App\Dice\Dice", $dice);
    }

    /**
     * Construct object and verify that the method roll() returns an integer
     * between 1 and 6.
     */
    public function testDiceRoll()
    {
        $dice = new Dice();

        $res = $dice->roll();
        $expLow = 1;
        $expHigh = 6;
        $this->assertGreaterThanOrEqual($expLow, $res);
        $this->assertLessThanOrEqual($expHigh, $res);
    }

    /**
     * Construct object and verify that the method getLastRoll() returns
     * the same value as roll().
     */
    public function testDiceGetLastRoll()
    {
        $dice = new Dice();

        $exp = $dice->roll();
        $res = $dice->getLastRoll();
        $this->assertEquals($exp, $res);
    }
}
