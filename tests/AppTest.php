<?php

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
        $html = <<<DOC
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="some description">
            <meta name="keywords" content="some keywords">
            <title>Page Analyzer</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
                  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        </head>
        <body>
        <h1>Header</h1>
        <p>Some text in paragraph</p>
        </body>

DOC;
        $mock = new MockHandler([
            new Response(200, ['Content-Length' => 4], 'body'),
            new Response(200, [], $html)
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
        $this->post('/domains', ['url' => 'http://domain2.com']);
        $this->seeInDatabase('domains', [
            'name' => 'domain2.com',
            'response_code' => 200,
            'main_header' => 'Header',
            'meta_keywords' => 'some keywords',
            'meta_description' => 'some description',
        ]);
    }
}
