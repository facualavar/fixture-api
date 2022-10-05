<?php

namespace Fixture\Domain\Game;

use Fixture\Domain\Group\Group;
use Fixture\Domain\Matchday\Matchday;
use Fixture\Domain\Stage\Stage;
use Fixture\Domain\Team\Team;

class Game
{
    private $id;
    private $team1;
    private $team2;
    private $stage;
    private $group;
    private $matchday;

    public function __construct(?int $id, Team $team1, Team $team2, Stage $stage, ?Group $group, Matchday $matchday)
    {
        $this->id       = $id;
        $this->team1    = $team1;
        $this->team2    = $team2;
        $this->stage    = $stage;
        $this->group    = $group;
        $this->matchday = $matchday;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTeam1(): Team
    {
        return $this->team1;
    }

    public function getTeam2(): Team
    {
        return $this->team2;
    }

    public function getStage(): Stage
    {
        return $this->stage;
    }

    public function getGroup(): ?Group
    {
        return $this->group;
    }

    public function getMatchday(): Matchday
    {
        return $this->matchday;
    }
}