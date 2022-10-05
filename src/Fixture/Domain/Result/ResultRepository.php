<?php

namespace Fixture\Domain\Result;

use Fixture\Domain\Game\Game;
use Fixture\Domain\Group\Group;
use Fixture\Domain\User\User;

interface ResultRepository
{
    public function save(Result $result): void;

    public function find(int $id): ?Result;

    public function findByUserAndGame(User $user, Game $game): ?Result;
}