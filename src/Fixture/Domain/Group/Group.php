<?php

namespace Fixture\Domain\Group;

use Fixture\Domain\Game\Game;
use Fixture\Domain\Team\Team;

class Group
{
    private $id;
    private $name;
    private $teams;
    private $games;

    public function __construct(int $id, string $name, array $teams = [], array $games = [])
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->teams = $teams;
        $this->games = $games;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Team[]
     */
    public function getTeams(): array
    {
        return $this->teams;
    }

    public function setTeams(array $teams): void
    {
        foreach ($teams as $team) {
            $this->addTeam($team);
        }
    }

    public function getGames(): array
    {
        return $this->games;
    }

    public function addTeam(Team $team)
    {
        $this->teams[] = $team;
    }
}