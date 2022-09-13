<?php

namespace App\Http\Controllers;

use App\Services\GroupService;
use App\Models\Game;
use App\Models\Group;
use Illuminate\Http\Request;

use function PHPUnit\Framework\matches;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with('teams')->get();
        return response()->json($groups, 200);
    }

    public function show(int $id)
    {
        $group = Group::with('teams', 'games.matchday', 'games.team1', 'games.team2')->find($id);
        return response()->json($group, 200);
    }

    public function games(int $id)
    {
        $games = Game::with('team1', 'team2', 'group', 'stage', 'matchday')->where('group_id', $id)->get();
        return response()->json($games, 200);
    }

    public function results(int $id, Request $request)
    {
        $results      = $request->all();
        $group        = Group::find($id);
        $groupService = new GroupService($group);
        $response     = $groupService->saveResults($results);
        return response()->json($response, 200);
    }
}
