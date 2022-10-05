<?php

namespace Fixture\Application\Services\Result;

use Fixture\Domain\Game\GameRepository;
use Fixture\Domain\Result\Result;
use Fixture\Domain\Result\ResultRepository;
use Fixture\Domain\User\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SaveResultsByUser
{
    private $gameRepository;
    private $resultRepository;

    public function __construct(GameRepository $gameRepository, ResultRepository $resultRepository)
    {
        $this->gameRepository = $gameRepository;
        $this->resultRepository = $resultRepository;
    }

    /**
     * @param User $user
     * @param array $results un array que contiene resultados
     * Un resultado: [game_id => int goals_team_1 => int, goals_team_2 => int]
     */
    public function __invoke(User $user, array $results): bool
    {

        foreach ($results as $result) {
            $game_id    = $result["game_id"];
            $goalsTeam1 = $result['goals_team_1'];
            $goalsTeam2 = $result['goals_team_2'];

            $game = $this->gameRepository->find($game_id);

            if (!$game) {
                throw new NotFoundHttpException("No se encontró el juego ". $result["game_id"]);
            }

            $saveResult = new SaveResultByUserAndGame($this->resultRepository);

            $saveResult->__invoke($user, $game, $goalsTeam1, $goalsTeam2);
        }

        return true;
    }
}