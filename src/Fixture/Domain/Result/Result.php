<?php

namespace Fixture\Domain\Result;

use Fixture\Domain\Game\Game;
use Fixture\Domain\Team\Team;
use Fixture\Domain\User\User;

class Result
{
    private $id;
    private $game;
    private $user;
    private $teamWinner;
    private $goalsTeam1;
    private $goalsTeam2;

    public function __construct(?int $id, User $user, Game $game, ?int $goalsTeam1, ?int $goalsTeam2)
    {
        $this->id         = $id;
        $this->user       = $user;
        $this->game       = $game;
        $this->goalsTeam1 = $goalsTeam1;
        $this->goalsTeam2 = $goalsTeam2;

        $this->determineWinner();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGoalsTeam1(): ?int
    {
        return $this->goalsTeam1;
    }

    public function getGoalsTeam2(): ?int
    {
        return $this->goalsTeam2;
    }

    public function setGoals(?int $goalsTeam1, ?int $goalsTeam2): void
    {
        // Si solo uno es null lo seteo en 0
        if ($goalsTeam1 === null xor $goalsTeam2 === null) {
            if ($goalsTeam1 === null) {
                $goalsTeam1 = 0;
            }

            if ($goalsTeam2 === null) {
                $goalsTeam2 = 0;
            }
        }

        $this->goalsTeam1 = $goalsTeam1;
        $this->goalsTeam2 = $goalsTeam2;

        $this->determineWinner();
    }

    public function determineWinner(): void
    {
        if ($this->goalsTeam1 > $this->goalsTeam2) {
            $this->teamWinner = $this->getGame()->getTeam1();
        }

        if ($this->goalsTeam1 < $this->goalsTeam2) {
            $this->teamWinner = $this->getGame()->getTeam2();
        }
    }

    public function getTeamWinner(): ?Team
    {
        return $this->teamWinner;
    }

    public function getGame(): Game
    {
        return $this->game;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}