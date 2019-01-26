<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

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
        $this->post('/domains', ['url' => 'http://domain.com']);
        $this->seeInDatabase('domains', ['name' => 'domain.com']);
    }
}
