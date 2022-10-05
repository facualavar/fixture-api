<?php

namespace Fixture\Domain\User;

interface UserRepository
{
    public function find(int $id): ?User;
}