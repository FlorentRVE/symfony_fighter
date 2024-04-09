<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthControllerTest extends WebTestCase
{
    public function testRegister(): void
    {
        $client = static::createClient();
        $client->request('POST', '/register', [], [], [], json_encode([
            'email' => 'test@gmail.com',

            'password' => 'password',
            'username' => 'test',
        ]));

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonStringEqualsJsonString('{"message":"User created"}', $client->getResponse()->getContent());
    }
}
