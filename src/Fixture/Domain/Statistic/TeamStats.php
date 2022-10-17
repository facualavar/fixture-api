<?php

namespace Fixture\Domain\Statistic;

use Fixture\Domain\Team\Team;
use Fixture\Domain\User\User;

class TeamStats
{
    private $id;
    private $user;
    private $team;
    private $partidosJugados;
    private $partidosGanados;
    private $partidosPerdidos;
    private $partidosEmpatados;
    private $golesAFavor;
    private $golesEnContra;
    private $diferenciaDeGoles;
    private $puntos;

    public function __construct(
        ?int $id,
        User $user,
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
        $this->id    = $id;
        $this->user  = $user;
        $this->team  = $team;

        $this->partidosJugados   = $partidosJugados;
        $this->partidosGanados   = $partidosGanados;
        $this->partidosEmpatados = $partidosEmpatados;
        $this->partidosPerdidos  = $partidosPerdidos;

        $this->golesAFavor       = $golesAFavor;
        $this->golesEnContra     = $golesEnContra;
        $this->diferenciaDeGoles = $diferenciaDeGoles;
        $this->puntos            = $puntos;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function resetStats(): void
    {
        $this->partidosJugados   = 0;
        $this->partidosGanados   = 0;
        $this->partidosEmpatados = 0;
        $this->partidosPerdidos  = 0;
        $this->golesAFavor       = 0;
        $this->golesEnContra     = 0;
        $this->diferenciaDeGoles = 0;
        $this->puntos            = 0;
    }

    public function addGameStats(int $golesAFavor, int $golesEnContra): void
    {
        $this->partidosJugados++;
        $this->golesAFavor += $golesAFavor;
        $this->golesEnContra += $golesEnContra;

        $this->diferenciaDeGoles = $this->golesAFavor - $this->golesEnContra;

        if ($golesAFavor > $golesEnContra) {
            $this->partidosGanados++;
            $this->puntos += 3;
        }

        if ($golesAFavor == $golesEnContra) {
            $this->partidosEmpatados++;
            $this->puntos += 1;
        }

        if ($golesAFavor < $golesEnContra) {
            $this->partidosPerdidos++;
        }
    }

    public function getPartidosJugados(): int
    {
        return $this->partidosJugados;
    }

    public function getPartidosGanados(): int
    {
        return $this->partidosGanados;
    }

    public function getPartidosEmpatados(): int
    {
        return $this->partidosEmpatados;
    }

    public function getPartidosPerdidos(): int
    {
        return $this->partidosPerdidos;
    }

    public function getGolesAFavor(): int
    {
        return $this->golesAFavor;
    }

    public function getGolesEnContra(): int
    {
        return $this->golesEnContra;
    }

    public function getDiferenciaDeGoles(): int
    {
        return $this->diferenciaDeGoles;
    }

    public function getPuntos(): int
    {
        return $this->puntos;
    }
}