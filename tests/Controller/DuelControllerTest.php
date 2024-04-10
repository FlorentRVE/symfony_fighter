<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DuelControllerTest extends WebTestCase
{
    public function testDuel(): void
    {
        $client = static::createClient();
        $client->request('GET', '/duel', [], [], [], json_encode([]));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
