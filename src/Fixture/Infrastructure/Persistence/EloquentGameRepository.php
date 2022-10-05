<?php

namespace Fixture\Infrastructure\Persistence;

use Fixture\Domain\Game\Game;
use Fixture\Domain\Game\GameRepository;
use Fixture\Domain\Group\Group;
use Fixture\Domain\Group\GroupRepository;
use Fixture\Domain\Matchday\MatchdayRepository;
use Fixture\Domain\Stage\StageRepository;
use Fixture\Domain\Team\TeamRepository;
use Fixture\Infrastructure\Persistence\Eloquent\GameEloquentModel;

final class EloquentGameRepository implements GameRepository
{
    private $teamRepository;
    private $groupRepository;
    private $stageRepository;
    private $matchdayRepository;

    public function __construct(
        TeamRepository $teamRepository,
        GroupRepository $groupRepository,
        StageRepository $stageRepository,
        MatchdayRepository $matchdayRepository,
    )
    {
        $this->teamRepository     = $teamRepository;
        $this->groupRepository    = $groupRepository;
        $this->stageRepository    = $stageRepository;
        $this->matchdayRepository = $matchdayRepository;
    }

    public function find(int $id): ?Game
    {
        $model = GameEloquentModel::find($id);

        if ($model === null) {
            return null;
        }

        $team1 = $this->teamRepository->find($model->team_1_id);
        $team2 = $this->teamRepository->find($model->team_2_id);

        $stage    = $this->stageRepository->find($model->stage_id);
        $group    = $this->groupRepository->find($model->group_id);
        $matchday = $this->matchdayRepository->find($model->matchday_id);

        if ($team1 === null || $team2 === null || $stage === null) {
            return null;
        }

        return new Game($model->id, $team1, $team2, $stage, $group, $matchday);
    }

    public function findByGroup(Group $group): array
    {
        $models = GameEloquentModel::where('group_id', $group->getId())->get();

        $games = [];
        foreach ($models as $model) {
            $games[] = $this->find($model->id);
        }

        return $games;
    }
}