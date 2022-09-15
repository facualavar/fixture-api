<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with('team1', 'team2', 'group', 'stage', 'matchday')->get();
        return response()->json($games, 200);
    }
}
