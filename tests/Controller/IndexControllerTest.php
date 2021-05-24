<?php

declare(strict_types=1);

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for the controller Index.
 */
class IndexControllerTest extends WebTestCase
{
    /**
     * Check that the controller returns a response.
     * Index.
     * @runInSeparateProcess
     */
    public function testControllerIndexResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }
}
