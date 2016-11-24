<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Board;

class BoardController extends Controller
{

	public function Index()
	{
		$boards = Board::all();

		return view('board.index', ['boards' => $boards]);
	}
	
	public function create()
	{
		return view('board.create');
	}
	
	public function done(Request $req)
	{
		$board = new Board();
		$board->title = $req->input('title');
		$board->content = $req->input('content');
		$board->save();
		
		return redirect('/boards');
		
	}
	
	
	
}