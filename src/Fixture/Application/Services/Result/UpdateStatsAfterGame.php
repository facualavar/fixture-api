<?php

namespace Fixture\Application\Services\Result;

use Fixture\Domain\Game\GameRepository;
use Fixture\Domain\Group\Group;
use Fixture\Domain\Result\Result;
use Fixture\Domain\Result\ResultRepository;
use Fixture\Domain\Statistic\StatisticRepository;
use Fixture\Domain\User\User;

class UpdateStatsAfterGame
{
    private $statisticRepository;
    private $resultRepository;
    private $gameRepository;

    public function __construct(StatisticRepository $statisticRepository, ResultRepository $resultRepository, GameRepository $gameRepository)
    {
        $this->statisticRepository = $statisticRepository;
        $this->resultRepository    = $resultRepository;
        $this->gameRepository      = $gameRepository;
    }

    public function __invoke(User $user, Group $group): void
    {
        $this->updateTeamStats($user, $group);
        $this->updateGroupStats($user, $group);
    }

    private function updateTeamStats(User $user, Group $group): void
    {
        foreach ($group->getTeams() as $team)
        {
            $teamStats = $this->statisticRepository->findOrCreateStatisticByUserAndTeam($user, $team);
            $teamStats->resetStats();
            $this->statisticRepository->saveTeamStats($teamStats);
        }

        $games = $this->gameRepository->findByGroup($group);

        foreach ($games as $game) {
            $result = $this->resultRepository->findByUserAndGame($user, $game);

            if (!$result || ($result->getGoalsTeam1() === null || $result->getGoalsTeam2() === null)) {
                continue;
            }

            $statsGameTeam1 = $this->statisticRepository->findOrCreateStatisticByUserAndTeam($user, $game->getTeam1());
            $statsGameTeam1->addGameStats($result->getGoalsTeam1(), $result->getGoalsTeam2());
            $this->statisticRepository->saveTeamStats($statsGameTeam1);

            $statsGameTeam2 = $this->statisticRepository->findOrCreateStatisticByUserAndTeam($user, $game->getTeam2());
            $statsGameTeam2->addGameStats($result->getGoalsTeam2(), $result->getGoalsTeam1());
            $this->statisticRepository->saveTeamStats($statsGameTeam2);
        }
    }

    private function updateGroupStats(User $user, Group $group): void
    {
        $firstPlace = null;
        $secondPlace = null;

        $statsFirstPlace  = null;
        $statsSecondPlace = null;

        foreach ($group->getTeams() as $team) {
            $teamStats = $this->statisticRepository->findOrCreateStatisticByUserAndTeam($user, $team);

            if (!$statsFirstPlace) {
                $statsFirstPlace = $teamStats;
                $firstPlace      = $team;
                continue;
            }

            if (!$statsSecondPlace) {
                $statsSecondPlace = $teamStats;
                $secondPlace      = $team;
                continue;
            }

            // Más puntos que el primer lugar, o puntos iguales al primer lugar y mayor diferencia de gol
            if ($teamStats->getPuntos() > $statsFirstPlace->getPuntos() || ($teamStats->getPuntos() == $statsFirstPlace->getPuntos() && $teamStats->getDiferenciaDeGoles() > $statsFirstPlace->getDiferenciaDeGoles())) {
                // El primer lugar pasa a ser el segundo
                $secondPlace = $firstPlace;
                $statsSecondPlace = $statsFirstPlace;

                // Nuevo primer lugar
                $statsFirstPlace = $teamStats;
                $firstPlace      = $team;
                continue;
            }

            // Más puntos que el segundo lugar, o puntos iguales al segundo lugar y mayor diferencia de gol
            if ($teamStats->getPuntos() > $statsSecondPlace->getPuntos() || ($teamStats->getPuntos() == $statsSecondPlace->getPuntos() && $teamStats->getDiferenciaDeGoles() > $statsSecondPlace->getDiferenciaDeGoles())) {
                // Nuevo segundo lugar
                $statsSecondPlace = $teamStats;
                $secondPlace      = $team;
            }
        }

        $groupStats = $this->statisticRepository->findOrCreateStatisticByUserAndGroup($user, $group);
        $groupStats->setSecondPlace($secondPlace);
        $groupStats->setFirstPlace($firstPlace);

        $this->statisticRepository->saveGroupStats($groupStats);
    }
}