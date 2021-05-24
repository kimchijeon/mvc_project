<?php

namespace App\Dice;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test cases for class GameResults.
 */
class GameResultsTest extends WebTestCase
{
    /**
     * Construct object and verify that the object is of the correct class.
     */
    public function testCreateGameObject()
    {
        $game = new GameResults();
        $this->assertInstanceOf("\App\Dice\GameResults", $game);
    }

    /**
     * Verify that if dicetotal is more than 21 you lose.
     */
    public function testShowResultsLoss()
    {
        $request = new Request();
        $request->create(
            '/game21/game',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();
        $session->set("dicetotal", 22);

        $game = new GameResults();
        $data = $game->showResults($request);

        $this->expectOutputString("You lose!");

        print $data["notice"];
    }

    /**
     * Verify that if dicetotal is 21 you win.
     */
    public function testShowResultsWin()
    {
        $request = new Request();
        $request->create(
            '/game21/game',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();
        $session->set("dicetotal", 21);

        $game = new GameResults();
        $data = $game->showResults($request);

        $this->expectOutputString("You win!");

        print $data["notice"];
    }

    /**
     * Verify that if dicehand is set it is equal
     * to $data["lastRoll"].
     */
    public function testShowResultsLastRollSet()
    {
        $request = new Request();
        $request->create(
            '/game21/game',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();
        $session->set("dicehand", 4);

        $game = new GameResults();
        $data = $game->showResults($request);

        $res = $data["lastRoll"];
        $exp = 4;
        $this->assertEquals($exp, $res);
    }
}
