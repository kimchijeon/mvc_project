<?php

namespace App\Dice;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test cases for class GamePrepare.
 */
class GamePrepareTest extends WebTestCase
{
    /**
     * Construct object and verify that the object is of the correct class.
     */
    public function testCreateGamePrepareObject()
    {
        $game = new GamePrepare();
        $this->assertInstanceOf("\App\Dice\GamePrepare", $game);
    }

    /**
     * Verify that the posted number is the same number saved in the session.
     * @runInSeparateProcess
     */
    public function testGameSetDiceNumber()
    {
        $client = static::createClient();
        $client->request('GET', '/game21');

        $client->submitForm('Play!', [
            'number' => '1',
        ]);

        $exp = "/game21/game";
        $this->assertResponseRedirects($exp);
    }

    /**
     * Verify that if prepareGame() is called the session is nullified correctly.
     */
    public function testGamePrepareGame()
    {
        $request = new Request();
        $request->create(
            '/game21',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();

        $session->set("number", 1);
        $session->set("dicehand", 1);
        $session->set("dicetotal", 1);
        $session->set("playertotal", 1);
        $session->set("bothand", 1);
        $session->set("bottotal", 1);
        $session->set("rounddices", 1);

        $game = new GamePrepare();
        $game->prepareGame($request);

        $this->assertEmpty($session->get("number"));
        $this->assertEmpty($session->get("dicehand"));
        $this->assertEmpty($session->get("dicetotal"));
        $this->assertEmpty($session->get("playertotal"));
        $this->assertEmpty($session->get("bothand"));
        $this->assertEmpty($session->get("bottotal"));
        $this->assertEmpty($session->get("rounddices"));
    }

    /**
     * Verify that saveRoundDices correctly saves dices to session.
     */
    public function testGameSaveRoundDices()
    {
        $request = new Request();
        $request->create(
            '/game21',
            'GET',
        );

        $request->setSession(new Session(new MockArraySessionStorage()));
        $session = $request->getSession();

        $session->set("rounddices", array(5));
        $session->set("saveddices", array(1));

        $game = new GamePrepare();
        $game->saveRoundDices($request);

        $this->assertContains(5, $session->get("saveddices"));
    }
}
