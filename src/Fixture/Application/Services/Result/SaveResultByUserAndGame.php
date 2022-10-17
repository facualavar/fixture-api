<?php

namespace Fixture\Application\Services\Result;

use Fixture\Domain\Game\Game;
use Fixture\Domain\Result\Result;
use Fixture\Domain\Result\ResultRepository;
use Fixture\Domain\User\User;

class SaveResultByUserAndGame
{
    private $resultRepository;

    public function __construct(ResultRepository $resultRepository)
    {
        $this->resultRepository = $resultRepository;
    }

    public function __invoke(User $user, Game $game, ?int $goalsTeam1, ?int $goalsTeam2): Result
    {
        // Busco el resultado, si no existe lo genero
        $result = $this->resultRepository->findByUserAndGame($user, $game);

        if (!$result) {
            $result = new Result(null, $user, $game, null, null);
        }

        $result->setGoals($goalsTeam1, $goalsTeam2);

        // Guardo el registro
        $this->resultRepository->save($result);

        return $result;
    }
}