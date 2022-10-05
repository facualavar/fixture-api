<?php

namespace Fixture\Infrastructure\Persistence;

use Fixture\Domain\Stage\Stage;
use Fixture\Domain\Stage\StageRepository;
use Fixture\Infrastructure\Persistence\Eloquent\StageEloquentModel;

final class EloquentStageRepository implements StageRepository
{
    public function find(int $id): ?Stage
    {
        $model = StageEloquentModel::find($id);

        if ($model === null) {
            return null;
        }

        return new Stage($model->id, $model->name);
    }
}