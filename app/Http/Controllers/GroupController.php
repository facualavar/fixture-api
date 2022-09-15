<?php

namespace App\Http\Controllers;

use App\Services\GroupService;
use App\Models\Game;
use App\Models\Group;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $group = Group::with('teams')->find($id);
        return response()->json($group, 200);
    }

    public function getResults(int $id, Request $request)
    {
        $user = $request->user();

        $games = Game::with('team1', 'team2', 'group', 'stage', 'matchday')->where('group_id', $id)->get();

        $results = [];
        foreach ($games as $game) {

            $resultUser = [
                'matchday'     => $game->matchday->name,
                'name_team_1'  => $game->team1->name,
                'flag_team_1'  => $game->team1->icon,
                'goals_team_1' => null,
                'name_team_2'  => $game->team2->name,
                'flag_team_2'  => $game->team2->icon,
                'goals_team_2' => null,
            ];

            foreach ($game->results as $result) {
                if ($result->user_id == $user->id) {
                    $resultUser['goals_team_1'] = $result->goals_team_1;
                    $resultUser['goals_team_2'] = $result->goals_team_2;
                }
            }

            $results[] = $resultUser;
        }

        return response()->json($results, 200);
    }

    public function postResults(int $id, Request $request)
    {
        $results = $request->all();
        $user    = $request->user();

        $group = Group::find($id);

        if (!$group) throw new NotFoundHttpException();

        $groupService = new GroupService($group);
        $response     = $groupService->saveResults($user, $results);

        return response()->json($response, 200);
    }
}
