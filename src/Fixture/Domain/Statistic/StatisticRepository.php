<?php

namespace Fixture\Domain\Statistic;

use Fixture\Domain\Group\Group;
use Fixture\Domain\Team\Team;
use Fixture\Domain\User\User;

interface StatisticRepository
{
    public function save(TeamStats $statisticTeam): void;

    public function findOrCreateStatisticByUserAndTeam(User $user, Team $team): TeamStats;

    public function findOrCreateStatisticByUserAndGroup(User $user, Group $group): GroupStats;
}