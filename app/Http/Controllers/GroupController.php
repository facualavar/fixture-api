<?php

namespace App\Http\Controllers;

use Fixture\Application\Services\Result\SaveResultsByUser;
use Fixture\Domain\Group\Group;
use Fixture\Domain\Team\Team;
use Fixture\Infrastructure\Persistence\EloquentGameRepository;
use Fixture\Infrastructure\Persistence\EloquentGroupRepository;
use Fixture\Infrastructure\Persistence\EloquentMatchdayRepository;
use Fixture\Infrastructure\Persistence\EloquentResultRepository;
use Fixture\Infrastructure\Persistence\EloquentStageRepository;
use Fixture\Infrastructure\Persistence\EloquentTeamRepository;
use Fixture\Infrastructure\Persistence\EloquentUserRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GroupController extends Controller
{
    private $stageRepository;
    private $matchdayRepository;
    private $groupRepository;
    private $teamRepository;
    private $resultRepository;
    private $gameRepository;
    private $userRepository;

    public function __construct()
    {
        $this->stageRepository    = new EloquentStageRepository();
        $this->matchdayRepository = new EloquentMatchdayRepository();
        $this->teamRepository     = new EloquentTeamRepository();
        $this->userRepository     = new EloquentUserRepository();
        $this->groupRepository    = new EloquentGroupRepository($this->teamRepository);
        $this->gameRepository     = new EloquentGameRepository($this->teamRepository, $this->groupRepository, $this->stageRepository, $this->matchdayRepository);
        $this->resultRepository   = new EloquentResultRepository($this->gameRepository, $this->userRepository);
    }

    private function serializeTeam(Team $team): array
    {
        return [
            'id'       => $team->getId(),
            'name'     => $team->getName(),
            'flag_img' => $team->getFlagImg(),
        ];
    }

    private function serializeGroup(Group $group): array
    {
        $teamsData = [];
        foreach ($group->getTeams() as $team) {
            $teamsData[] = $this->serializeTeam($team);
        }

        return $response[] = [
            'id'    => $group->getId(),
            'name'  => $group->getName(),
            'teams' => $teamsData,
        ];
    }

    public function index()
    {
        $groups = $this->groupRepository->all();

        $response = [];
        foreach ($groups as $group) {
            $response[] = $this->serializeGroup($group);
        }

        return response()->json($response, 200);
    }

    public function show(int $id)
    {
        $group = $this->groupRepository->find($id);

        if (!$group) throw new NotFoundHttpException("No se encontró el grupo");

        $teams = $this->teamRepository->findByGroup($group);

        $teamsData = [];
        foreach ($teams as $team) {
            $teamsData[] = [
                'id'       => $team->getId(),
                'name'     => $team->getName(),
                'flag_img' => $team->getFlagImg(),
            ];
        }

        $response = [
            'id'    => $group->getId(),
            'name'  => $group->getName(),
            'teams' => $teamsData,
        ];

        return response()->json($response, 200);
    }

    public function getResults(int $id, Request $request)
    {
        $authUser = $request->user();

        $group = $this->groupRepository->find($id);
        $user  = $this->userRepository->find($authUser->id);

        if (!$group) throw new NotFoundHttpException("No se encontró el grupo");
        if (!$user) throw new NotFoundHttpException("No se encontró el usuario");

        $games = $this->gameRepository->findByGroup($group);

        $response = [];
        foreach ($games as $game)
        {
            $result = $this->resultRepository->findByUserAndGame($user, $game);

            $response[] = [
                'game_id'     => $game->getId(),
                'stage'       => $game->getStage()->getName(),
                'matchday'    => $game->getMatchday()->getName(),
                'name_team_1' => $game->getTeam1()->getName(),
                'flag_team_1' => $game->getTeam1()->getFlagImg(),
                'name_team_2' => $game->getTeam2()->getName(),
                'flag_team_2' => $game->getTeam2()->getFlagImg(),
                'goals_team_1' => $result?->getGoalsTeam1(),
                'goals_team_2' => $result?->getGoalsTeam2(),
            ];
        }

        return response()->json($response, 200);
    }

    public function postResults(int $id, Request $request)
    {
        $results = $request->all();
        $authUser = $request->user();

        $user  = $this->userRepository->find($authUser->id);
        $group = $this->groupRepository->find($id);

        if (!$group) throw new NotFoundHttpException("No se encontró el grupo");
        if (!$user) throw new NotFoundHttpException("No se encontró el usuario");

        $saveResults = new SaveResultsByUser($this->gameRepository, $this->resultRepository);
        $response    = $saveResults->__invoke($user, $results);

        return response()->json($response, 200);
    }
}
