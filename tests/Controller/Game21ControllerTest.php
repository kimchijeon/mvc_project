<?php

declare(strict_types=1);

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Test cases for the controller Game21.
 */
class Game21ControllerTest extends WebTestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Game21Controller();
        $this->assertInstanceOf("\App\Controller\Game21Controller", $controller);
    }

    /**
     * Check that the controller returns a response.
     * Index
     * @runInSeparateProcess
     */
    public function testIndexResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Check that the controller's response redirects correctly.
     * Game Process
     * @runInSeparateProcess
     */
    public function testGameProcessResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21/process');

        $exp = "/game21/game";
        $this->assertResponseRedirects($exp);
    }

    /**
     * Check that the controller returns a response.
     * Game
     * @runInSeparateProcess
     */
    public function testGameResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21/game');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Check that the controller's response redirects correctly.
     * Play Process
     * @runInSeparateProcess
     */
    public function testPlayProcessResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21/play');

        $exp = "/game21/game";
        $this->assertResponseRedirects($exp);
    }

    /**
     * Check that the controller's response redirects correctly.
     * Bot Process
     * @runInSeparateProcess
     */
    public function testBotProcessResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21/bot/process');

        $exp = "/game21/bot/game";
        $this->assertResponseRedirects($exp);
    }

    /**
     * Check that the controller returns a response.
     * Bot Game
     * @runInSeparateProcess
     */
    public function testBotGameResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21/bot/game');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Check that the controller's response redirects correctly.
     * Bot Play Process
     * @runInSeparateProcess
     */
    public function testBotPlayResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21/bot/play');

        $exp = "/game21/result";
        $this->assertResponseRedirects($exp);
    }

    /**
     * Check that the controller returns a response.
     * Result
     * @runInSeparateProcess
     */
    public function testResultResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21/result');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Check that the controller's response redirects correctly.
     * Restart
     * @runInSeparateProcess
     */
    public function testRestartResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21/restart');

        $exp = "/game21";
        $this->assertResponseRedirects($exp);
    }
}
