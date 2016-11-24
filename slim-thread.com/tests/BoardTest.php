<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BoardTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
	public function testIndex()
	{
		$first=factory(App\Board::class)->create();
		$second=factory(App\Board::class)->create();
		$first->save();
		$second->save();
		
		$this->visit('/boards')
		->see('掲示板のテスト')
		
		->see($first->title)
		->see($first->content)
		
		->see($second->title)
		->see($second->content);
	}
		
	public function testCreate()
	{
		$this->visit('boards')
		->click('新規投稿')
		->seePageIs('/boards/create')
		
		->type('タイトル１','title')
		->type('本文１','content')
		->press('送信')
		
		->seePageIs('/boards')
		->see('タイトル１')
		->see('本文１');
		
	}
}
