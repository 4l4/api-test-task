<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class GroupControllerTest extends WebTestCase
{

    public function testGetGroups()
    {
        $client = static::createClient();

        $client->request('GET', '/groups');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testGetGroup()
    {
        $client = static::createClient();

        $client->request('GET', '/groups/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testPostGroup()
    {
        $client = static::createClient();

        $client->request('POST', '/groups', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{
                        "name": "Post"
                    }'
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testPutGroup()
    {
        $client = static::createClient();

        $client->request('PUT', '/groups/1', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{
                        "name": "Put"
                    }'
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testInvalidData()
    {
        $client = static::createClient();

        $client->request('POST', '/groups', [], [], ['CONTENT_TYPE' => 'application/json'],
            '{
                        "name": "Invalid",
                    }'
        );

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}
