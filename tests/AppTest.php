<?php

use Illuminate\Support\Facades\DB;
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
        $this->assertResponseOk();
    }
    
    public function testDomainsPage()
    {
        DB::insert('insert into domains (name) values (?)', ['testDomain1']);
        DB::insert('insert into domains (name) values (?)', ['testDomain2']);
        $this->get('/domains');
        $this->assertResponseOk();
    }
    
    public function testDatabaseCreateRaw()
    {
        $this->post('/domains', ['url' => 'http://domain.com']);
        $this->seeInDatabase('domains', ['name' => 'domain.com']);
    }
}
