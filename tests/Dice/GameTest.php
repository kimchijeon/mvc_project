<?php

namespace App\Dice;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test cases for class Game.
 */
class GameTest extends WebTestCase
{
    /**
     * Verify that the first time playGame() is called that $_SESSION["dicetotal"]
     * contains the sum of $_SESSION["dicehand"].
     */
    public function testGamePlayGame()
    {
        $request = new Request();
        $request->create(
            '/game21/play',
            'GET'
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();

        $game = new Game();
        $session->set("number", 1);
        $session->set("dicetotal", null);

        $game->playGame($request);

        $res = $session->get("dicetotal");
        $exp = array_sum($session->get("dicehand"));
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that setRoundDices correctly sets round dices when it's already set.
     */
    public function testGameSetRoundDicesSet()
    {
        $request = new Request();
        $request->create(
            '/game21/play',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();

        $session->set("dicehand", array(5));
        $session->set("rounddices", array(1));

        $game = new Game();
        $game->setRoundDices($request);

        $this->assertContains(5, $session->get("rounddices"));
    }

    /**
     * Verify that setRoundDices correctly sets round dices when it's unset.
     */
    public function testGameSetRoundDicesUnset()
    {
        $request = new Request();
        $request->create(
            '/game21/play',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();

        $session->set("dicehand", array(5));
        $session->set("rounddices", null);

        $game = new Game();
        $game->setRoundDices($request);

        $this->assertContains(5, $session->get("rounddices"));
    }

    /**
     * Verify that the posted 'playerdice' is the same number saved in
     * $_SESSION["playertotal"].
     */
    public function testGameSavePlayerTotal()
    {
        $request = Request::create(
            '/game21/bot/process',
            'POST',
            [
                'playerdice' => 19,
                'submit' => "Stop rolling"
            ],
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();

        $game = new Game();
        $game->savePlayerTotal($request);

        $res = $session->get("playertotal");
        $exp = 19;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that $data after prepareBotGame() is correct.
     */
    public function testGamePrepareBotGame()
    {
        $request = new Request();
        $request->create(
            '/game21/bot/game',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();
        $session->set("playertotal", 15);
        $session->set("playercoins", 10);
        $session->set("botcoins", 100);
        $session->set("rounddices", [1, 2, 5]);

        $game = new Game();

        $data = $game->prepareBotGame($request);

        $res = $data["getPlayerTotal"];
        $exp = 15;
        $this->assertEquals($exp, $res);

        $res = $data["getPlayerCoins"];
        $exp = 10;
        $this->assertEquals($exp, $res);

        $res = $data["getBotCoins"];
        $exp = 100;
        $this->assertEquals($exp, $res);

        $this->assertContains(5, $session->get("rounddices"));
    }

    /**
     * Verify that posted player bet is session playerbet.
     */
    public function testGamePrepareBet()
    {
        $request = Request::create(
            '/game21/bot/play',
            'POST',
            [
                'bet' => 5,
                'submit' => "Let bot play"
            ],
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();

        $game = new Game();
        $game->prepareBet($request);

        $res = $session->get("playerbet");
        $exp = 5;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify the bot will roll until it has a higher number than the player.
     */
    public function testGameBotRoll()
    {
        $request = new Request();
        $request->create(
            '/game21/bot/play',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();
        $session->set("bottotal", null);
        $session->set("playertotal", 19);

        $game = new Game();
        $game->botRoll($request);

        $this->assertGreaterThanOrEqual($session->get("playertotal"), $session->get("bottotal"));
    }
}
