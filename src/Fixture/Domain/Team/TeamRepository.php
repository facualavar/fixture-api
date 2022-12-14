<?php

namespace Fixture\Domain\Team;

use Fixture\Domain\Group\Group;

interface TeamRepository
{
    public function save(Team $team): void;

    public function find(?string $id): ?Team;

    public function findByGroup(Group $group): array;
}