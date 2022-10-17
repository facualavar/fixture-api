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

    public function __invoke(User $user, Group $group): bool
    {
        foreach ($group->getTeams() as $team)
        {
            $statsTeam = $this->statisticRepository->findOrCreateStatisticByUserAndTeam($user, $team);
            $statsTeam->resetStats();
            $this->statisticRepository->save($statsTeam);
        }

        $games = $this->gameRepository->findByGroup($group);

        foreach ($games as $game) {
            $result = $this->resultRepository->findByUserAndGame($user, $game);

            if (!$result || ($result->getGoalsTeam1() === null || $result->getGoalsTeam2() === null)) {
                continue;
            }

            $statsGameTeam1 = $this->statisticRepository->findOrCreateStatisticByUserAndTeam($user, $game->getTeam1());
            $statsGameTeam1->addGameStats($result->getGoalsTeam1(), $result->getGoalsTeam2());
            $this->statisticRepository->save($statsGameTeam1);

            $statsGameTeam2 = $this->statisticRepository->findOrCreateStatisticByUserAndTeam($user, $game->getTeam2());
            $statsGameTeam2->addGameStats($result->getGoalsTeam2(), $result->getGoalsTeam1());
            $this->statisticRepository->save($statsGameTeam2);
        }

        return true;
    }
}