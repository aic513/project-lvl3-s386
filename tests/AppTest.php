<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AppTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');
        $expected = file_get_contents(__DIR__ . '/fixtures/index.txt');
        $this->assertEquals(
            $expected,
            $this->response->getContent()
        );
    }
}
