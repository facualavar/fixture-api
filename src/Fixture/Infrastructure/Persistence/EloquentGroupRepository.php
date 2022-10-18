<?php

namespace Fixture\Infrastructure\Persistence;

use Fixture\Domain\Group\Group;
use Fixture\Domain\Group\GroupRepository;
use Fixture\Domain\Team\TeamRepository;
use Fixture\Infrastructure\Persistence\Eloquent\GroupEloquentModel;

final class EloquentGroupRepository implements GroupRepository
{
    private $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function find(string $id): ?Group
    {
        $model = GroupEloquentModel::find($id);

        if ($model === null) {
            return null;
        }

        $group = new Group($model->id, $model->name);

        $teams = $this->teamRepository->findByGroup($group);

        $group->setTeams($teams);

        return $group;
    }

    public function all(): array
    {
        $models = GroupEloquentModel::all();

        $groups = [];
        foreach ($models as $model)
        {
            $groups[] = $this->find($model->id);
        }

        return $groups;
    }

    public function save(Group $group): void
    {
        $model = new GroupEloquentModel();
        $model->id = $group->id;
        $model->name = $group->name;

        $model->save();
    }
}