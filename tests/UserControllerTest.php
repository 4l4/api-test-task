<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class UserControllerTest extends WebTestCase
{

    public function testGetUsers()
    {
        $client = static::createClient();

        $client->request('GET', '/users');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testGetUser()
    {
        $client = static::createClient();

        $client->request('GET', '/users/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testPostUser()
    {
        $client = static::createClient();

        $client->request('POST', '/users', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{
                        "email": "post@test.as",
                        "firstName": "Post",
                        "lastName": "Test",
                        "group": null,
                        "state": false
                    }'
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testPutUser()
    {
        $client = static::createClient();

        $client->request('PUT', '/users/1', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{
                        "email": "put@test.as",
                        "firstName": "Put",
                        "lastName": "Test",
                        "group": null,
                        "state": false
                    }'
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testInvalidData()
    {
        $client = static::createClient();

        $client->request('POST', '/users', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{
                        "email": "InvalidTest.as",
                        "firstName": "Invalid",
                        "lastName": "Test",
                        "group": null,
                        "state": false
                    }'
        );

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}
