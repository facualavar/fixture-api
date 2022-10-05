<?php

namespace Fixture\Infrastructure\Persistence;

use Fixture\Domain\User\User;
use Fixture\Domain\User\UserRepository;
use Fixture\Infrastructure\Persistence\Eloquent\UserEloquentModel;

final class EloquentUserRepository implements UserRepository
{
    public function find(int $id): ?User
    {
        $model = UserEloquentModel::find($id);

        if ($model === null) {
            return null;
        }

        return new User($model->id, $model->name, $model->email);
    }
}