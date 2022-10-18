<?php

namespace Fixture\Domain\Matchday;

interface MatchdayRepository
{
    public function find(string $id): ?Matchday;
}