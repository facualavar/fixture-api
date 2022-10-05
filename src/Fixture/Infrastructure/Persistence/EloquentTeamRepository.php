<?php

namespace Fixture\Infrastructure\Persistence;

use Fixture\Domain\Group\Group;
use Fixture\Domain\Team\Team;
use Fixture\Domain\Team\TeamRepository;
use Fixture\Infrastructure\Persistence\Eloquent\TeamEloquentModel;

final class EloquentTeamRepository implements TeamRepository
{
    public function save(Team $team): void
    {
        $model = new TeamEloquentModel();
        $model->id = $team->id;
        $model->name = $team->name;

        $model->save();
    }

    public function find(int $id): ?Team
    {
        $model = TeamEloquentModel::find($id);

        if ($model === null) {
            return null;
        }

        return new Team($model->id, $model->name, $model->icon);
    }

    public function findByGroup(Group $group): array
    {
        $models = TeamEloquentModel::where('group_id', $group->getId())->get();

        $teams = [];
        foreach ($models as $model)
        {
            $teams[] = new Team($model->id, $model->name, $model->icon);
        }

        return $teams;
    }
}