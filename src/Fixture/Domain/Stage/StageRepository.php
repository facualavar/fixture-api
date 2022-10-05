<?php

namespace Fixture\Domain\Stage;

interface StageRepository
{
    public function find(int $id): ?Stage;
}