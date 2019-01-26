<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class AppTest extends TestCase
{
    public function testExample()
    {
        $this->get('/');
        $this->assertResponseOk();
    }
    
    public function testDomainsPage()
    {
        factory('App\Domain', 5)->create();
        $this->get('/domains');
        $this->assertResponseOk();
    }
    
    public function testDatabaseCreateRaw()
    {
        $mock = new MockHandler([
            new Response(200, ['Content-Length' => 4], 'body')
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $this->app->instance(\GuzzleHttp\Client::class, $client);
    
        $this->post('/domains', ['url' => 'http://domain.com']);
        $this->seeInDatabase('domains', [
            'name' => 'domain.com',
            'page_body' => 'body',
            'content_length' => 4,
            'response_code' => 200
        ]);
    }
}
