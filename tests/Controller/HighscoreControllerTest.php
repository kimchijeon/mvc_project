<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for the controller Highscore.
 */
class HighscoreControllerTest extends WebTestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new HighscoreController();
        $this->assertInstanceOf("\App\Controller\HighscoreController", $controller);
    }

    /**
     * Check that the controller returns a response.
     * Index
     * @runInSeparateProcess
     */
    public function testHighscoreIndexResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21/highscore');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Check that the controller's response redirects correctly.
     * Highscore Process
     * @runInSeparateProcess
     */
    public function testHighscoreProcessResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21/result');

        $client->submitForm('Save and end game', [
            'name' => 'Test',
            'rounds' => '4',
            'wins' => '2',
            'losses' => '2',
            'playercoins' => '10',
            'botcoins' => '100',
            'dicetotal' => '20',
        ]);

        $exp = "/game21/highscore";
        $this->assertResponseRedirects($exp);
    }

    /**
     * Check that the controller returns a response.
     * Show Player
     * @runInSeparateProcess
     */
    public function testShowPlayerResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/game21/highscore/name/Kimchi');

        $this->assertResponseIsSuccessful();
    }
}
