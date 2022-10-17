<?php

namespace Fixture\Domain\GroupStatistic;

use Fixture\Domain\Group\Group;
use Fixture\Domain\Statistic\TeamStats;
use Fixture\Domain\Team\Team;
use Fixture\Domain\User\User;

class GroupStatistic extends TeamStats
{
    private $group;

    public function __construct(
        ?int $id,
        User $user,
        Group $group,
        Team $team,
        int $partidosJugados,
        int $partidosGanados,
        int $partidosEmpatados,
        int $partidosPerdidos,
        int $golesAFavor,
        int $golesEnContra,
        int $diferenciaDeGoles,
        int $puntos,
    )
    {
        parent::__construct($id, $user, $team, $partidosJugados, $partidosGanados, $partidosEmpatados, $partidosPerdidos, $golesAFavor, $golesEnContra, $diferenciaDeGoles, $puntos);
        $this->group = $group;
    }
}