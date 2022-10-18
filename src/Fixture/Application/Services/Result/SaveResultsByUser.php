<?php

namespace Fixture\Application\Services\Result;

use Fixture\Domain\Game\GameRepository;
use Fixture\Domain\Group\Group;
use Fixture\Domain\Result\ResultRepository;
use Fixture\Domain\Statistic\StatisticRepository;
use Fixture\Domain\User\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SaveResultsByUser
{
    private $gameRepository;
    private $resultRepository;
    private $statisticRepository;

    public function __construct(GameRepository $gameRepository, ResultRepository $resultRepository, StatisticRepository $statisticRepository)
    {
        $this->gameRepository = $gameRepository;
        $this->resultRepository = $resultRepository;
        $this->statisticRepository = $statisticRepository;
    }

    /**
     * @param User $user
     * @param array $resultsData un array que contiene resultados
     * Un resultado: [game_id => [goals_team_1 => int, goals_team_2 => int]]
     */
    public function __invoke(User $user, Group $group, array $resultsData): bool
    {
        foreach ($resultsData as $gameId => $resultData) {
            $goalsTeam1 = $resultData['goals_team_1'];
            $goalsTeam2 = $resultData['goals_team_2'];

            $game = $this->gameRepository->find($gameId);

            if (!$game) {
                throw new NotFoundHttpException("No se encontró el juego ". $gameId);
            }

            $saveResult = new SaveResultByUserAndGame($this->resultRepository);
            $saveResult->__invoke($user, $game, $goalsTeam1, $goalsTeam2);
        }

        $updateStats = new UpdateStatsAfterGame($this->statisticRepository, $this->resultRepository, $this->gameRepository);
        $updateStats->__invoke($user, $group);

        return true;
    }
}