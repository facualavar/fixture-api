<?php

namespace Fixture\Infrastructure\Persistence;

use Fixture\Domain\Matchday\Matchday;
use Fixture\Domain\Matchday\MatchdayRepository;
use Fixture\Infrastructure\Persistence\Eloquent\MatchdayEloquentModel;

final class EloquentMatchdayRepository implements MatchdayRepository
{
    public function find(int $id): ?Matchday
    {
        $model = MatchdayEloquentModel::find($id);

        if ($model === null) {
            return null;
        }

        return new Matchday($model->id, $model->name);
    }
}