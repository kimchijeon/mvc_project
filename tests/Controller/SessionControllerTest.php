<?php

declare(strict_types=1);

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for the controller Session.
 */
class SessionControllerTest extends WebTestCase
{
    /**
     * Check that the controller returns a response.
     * Index.
     * @runInSeparateProcess
     */
    public function testSessionIndexResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/session');

        $this->assertResponseIsSuccessful();
    }

    /**
     * Check that the controller returns a response.
     * Session Destroy
     * @runInSeparateProcess
     */
    public function testSessionDestroyResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/session/destroy');

        $exp = "/session";
        $this->assertResponseRedirects($exp);
    }
}
