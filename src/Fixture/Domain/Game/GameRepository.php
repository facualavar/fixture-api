<?php

namespace Fixture\Domain\Game;

use Fixture\Domain\Group\Group;
use Fixture\Domain\User\User;

interface GameRepository
{
    public function find(int $id): ?Game;

    /**
     * @return array<Game>
     */
    public function findByGroup(Group $group): array;
}