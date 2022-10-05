<?php

namespace Fixture\Infrastructure\Persistence;

use Fixture\Domain\Game\Game;
use Fixture\Domain\Game\GameRepository;
use Fixture\Domain\Result\Result;
use Fixture\Domain\Result\ResultRepository;
use Fixture\Domain\User\User;
use Fixture\Domain\User\UserRepository;
use Fixture\Infrastructure\Persistence\Eloquent\ResultEloquentModel;

final class EloquentResultRepository implements ResultRepository
{
    private $gameRepository;
    private $userRepository;

    public function __construct(GameRepository $gameRepository, UserRepository $userRepository)
    {
        $this->gameRepository = $gameRepository;
        $this->userRepository = $userRepository;
    }

    public function save(Result $result): void
    {
        $model = ResultEloquentModel::find($result->getId());

        if (!$model) {
            $model = new ResultEloquentModel();
        }

        $model->game_id        = $result->getGame()->getId();
        $model->user_id        = $result->getUser()->getId();
        $model->goals_team_1   = $result->getGoalsTeam1();
        $model->goals_team_2   = $result->getGoalsTeam2();
        $model->team_winner = $result->getTeamWinner() ? $result->getTeamWinner()->getId() : null;

        $model->save();
    }

    public function find(int $id): ?Result
    {
        $model = ResultEloquentModel::find($id);

        if ($model === null) {
            return null;
        }

        $game = $this->gameRepository->find($model->game_id);
        $user = $this->userRepository->find($model->user_id);

        return new Result($model->id, $user, $game, $model->goals_team_1, $model->goals_team_2);
    }

    public function findByUserAndGame(User $user, Game $game): ?Result
    {
        $model = ResultEloquentModel::where('user_id', $user->getId())->where('game_id', $game->getId())->first();

        if (!$model) {
            return null;
        }

        return new Result($model->id, $user, $game, $model->goals_team_1, $model->goals_team_2);
    }
}