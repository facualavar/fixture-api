<?php

namespace Fixture\Domain\Statistic;

use Fixture\Domain\Group\Group;
use Fixture\Domain\Team\Team;
use Fixture\Domain\User\User;

class GroupStats
{
    private $id;
    private $user;
    private $group;
    private $firstPlace;
    private $secondPlace;

    public function __construct(int $id, User $user, Group $group, ?Team $firstPlace, ?Team $secondPlace)
    {
        $this->id          = $id;
        $this->user        = $user;
        $this->group       = $group;
        $this->firstPlace  = $firstPlace;
        $this->secondPlace = $secondPlace;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstPlace(): ?Team
    {
        return $this->firstPlace;
    }

    public function getSecondPlace(): ?Team
    {
        return $this->secondPlace;
    }

    public function setFirstPlace(?Team $team): void
    {
        $this->firstPlace = $team;
    }

    public function setSecondPlace(?Team $team): void
    {
        $this->secondPlace = $team;
    }
}