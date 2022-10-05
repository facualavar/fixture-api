<?php

namespace Fixture\Domain\Matchday;

interface MatchdayRepository
{
    public function find(int $id): ?Matchday;
}