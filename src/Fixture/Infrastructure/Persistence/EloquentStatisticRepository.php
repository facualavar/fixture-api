<?php

namespace Fixture\Infrastructure\Persistence;

use Fixture\Domain\Statistic\StatisticRepository;
use Fixture\Domain\Statistic\TeamStats;
use Fixture\Domain\Team\Team;
use Fixture\Domain\User\User;
use Fixture\Infrastructure\Persistence\Eloquent\TeamStatsEloquentModel;

final class EloquentStatisticRepository implements StatisticRepository
{
    public function save(TeamStats $teamStats): void
    {
        $model = TeamStatsEloquentModel::find($teamStats->getId());

        if (!$model) {
            $model = new TeamStatsEloquentModel();
            $model->user_id = $teamStats->getUser()->getId();
            $model->team_id = $teamStats->getTeam()->getId();
        }

        $model->partidos_jugados    = $teamStats->getPartidosJugados();
        $model->partidos_ganados    = $teamStats->getPartidosGanados();
        $model->partidos_empatados  = $teamStats->getPartidosEmpatados();
        $model->partidos_perdidos   = $teamStats->getPartidosPerdidos();
        $model->goles_a_favor       = $teamStats->getGolesAFavor();
        $model->goles_en_contra     = $teamStats->getGolesEnContra();
        $model->diferencia_de_goles = $teamStats->getDiferenciaDeGoles();
        $model->puntos              = $teamStats->getPuntos();
        $model->save();
    }

    public function findOrCreateStatisticByUserAndTeam(User $user, Team $team): TeamStats
    {
        $model = TeamStatsEloquentModel::where("team_id", $team->getId())
            ->where("user_id", $user->getId())
            ->first();

        if (!$model) {
            $model = new TeamStatsEloquentModel();
            $model->user_id = $user->getId();
            $model->team_id = $team->getId();
            $model->partidos_jugados = 0;
            $model->partidos_ganados = 0;
            $model->partidos_empatados = 0;
            $model->partidos_perdidos = 0;
            $model->goles_a_favor = 0;
            $model->goles_en_contra = 0;
            $model->diferencia_de_goles = 0;
            $model->puntos = 0;
            $model->save();
        }

        return new TeamStats(
            $model->id,
            $user,
            $team,
            $model->partidos_jugados,
            $model->partidos_ganados,
            $model->partidos_empatados,
            $model->partidos_perdidos,
            $model->goles_a_favor,
            $model->goles_en_contra,
            $model->diferencia_de_goles,
            $model->puntos
        );
    }
}