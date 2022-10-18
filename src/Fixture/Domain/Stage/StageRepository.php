<?php

namespace Fixture\Domain\Stage;

interface StageRepository
{
    public function find(string $id): ?Stage;
}