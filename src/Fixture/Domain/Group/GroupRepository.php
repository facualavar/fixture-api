<?php

namespace Fixture\Domain\Group;

interface GroupRepository
{
    public function save(Group $group): void;

    public function find(string $id): ?Group;

    public function all(): array;
}