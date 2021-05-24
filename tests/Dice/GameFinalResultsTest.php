<?php

namespace App\Dice;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test cases for class GameFinalResults.
 */
class GameFinalResultsTest extends WebTestCase
{
    /**
     * Verify that $data after setTotals() is correct.
     */
    public function testSetTotals()
    {
        $request = new Request();
        $request->create(
            '/game21/result',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();
        $session->set("playertotal", 19);
        $session->set("bottotal", 21);

        $game = new GameFinalResults();

        $data = $game->setTotals($request);

        $res = $data["getPlayerTotal"];
        $exp = 19;
        $this->assertEquals($exp, $res);

        $res = $data["getBotTotal"];
        $exp = 21;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that $data["getResultMessage"] is correct when draw.
     */
    public function testShowFinalResultsDraw()
    {
        $request = new Request();
        $request->create(
            '/game21/result',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();

        $session->set("playertotal", 22);

        $game = new GameFinalResults();
        $data = $game->showFinalResults($request);

        $this->expectOutputString("You're both losers.");

        print $data["getResultMessage"];
    }

    /**
     * Verify that $data after a win is correct.
     */
    public function testResultsWin()
    {
        $request = new Request();
        $request->create(
            '/game21/result',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();

        $session->set("playertotal", 21);
        $game = new GameFinalResults();
        $game->showFinalResults($request);

        $session->set("playercoins", 10);
        $session->set("botcoins", 100);
        $session->set("playerbet", 5);

        $bets = $game->showBettingResults($request);
        $scoreboard = $game->showScoreboard($request);

        $data = $bets + $scoreboard;

        $res = $data["getPlayerCoins"];
        $exp = 15;
        $this->assertEquals($exp, $res);

        $res = $data["getWins"];
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that $data after a loss is correct.
     */
    public function testResultsLoss()
    {
        $request = new Request();
        $request->create(
            '/game21/result',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();

        $session->set("playertotal", 19);
        $session->set("bottotal", 20);
        $game = new GameFinalResults();
        $game->showFinalResults($request);

        $session->set("playercoins", 10);
        $session->set("botcoins", 100);
        $session->set("playerbet", 5);

        $bets = $game->showBettingResults($request);
        $scoreboard = $game->showScoreboard($request);

        $data = $bets + $scoreboard;

        $res = $data["getPlayerCoins"];
        $exp = 5;
        $this->assertEquals($exp, $res);

        $res = $data["getLosses"];
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that correct histogram is printed.
     */
    public function testPrintHistogram()
    {
        $request = new Request();
        $request->create(
            '/game21/result',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();
        $session->set("saveddices", [1, 2, 3, 4, 5, 6]);

        $game = new GameFinalResults();

        $data = $game->printHistogram($request);

        $res = $data["getDiceTotal"];
        $exp = 6;
        $this->assertEquals($exp, $res);
    }
}
