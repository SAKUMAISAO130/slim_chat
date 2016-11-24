<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $page = $this->visit('http://localhost/login');
        $page->type('GNqZW6Aq7QlsAjIIDtW5S2BWblLg60hx6p8g6Zhj','_token')
        ->type('colorfullweb+100@gmail.com','email')
        ->type('orunitin','password')
        ->click('Login');
//        ->seePageIs('/home');
    }
}
