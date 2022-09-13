<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Result;

class GroupService
{
    private $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function saveResults(array $results): bool
    {
        $resultNormalized = $this->normalizeresults($results);

        $games = $this->group->games;

        foreach ($games as $key => $game) {
            $goalsTeam1 = $resultNormalized[$key]['goals_team_1'];
            $goalsTeam2 = $resultNormalized[$key]['goals_team_2'];

            // Si ambos son null no tiene en cuenta el resultado
            if ($goalsTeam1 === null && $goalsTeam2 === null) {
                continue;
            }

            // Si solo uno es null lo seteo en 0
            if ($goalsTeam1 === null || $goalsTeam2 === null) {
                if ($goalsTeam1 === null) {
                    $goalsTeam1 = 0;
                }

                if ($goalsTeam2 === null) {
                    $goalsTeam2 = 0;
                }
            }

            // Busco el resultado, si no existe lo genero
            $result = Result::where('game_id', $game->id)->first();

            if (!$result) {
                $result = new Result();
                $result->game_id = $game->id;
            }

            // Seteo un ganador, si lo hubiera
            if ($goalsTeam1 > $goalsTeam2) {
                $result->team_winner = $game->team1->id;
            }

            if ($goalsTeam1 < $goalsTeam2) {
                $result->team_winner = $game->team2->id;
            }

            $result->goals_team_1 = $goalsTeam1;
            $result->goals_team_2 = $goalsTeam2;

            // Guardo el registro
            $result->save();
        }

        return true;
    }

    /**
     * Se agrupan en pares los elementos del array inicial
     * Cada par de elemntos representa el resultado de un partido
     *
     * @param array $results Un array con 12 elementos de tipo int (goles)
     * @return array Array con 6 elementos de tipo array (resultado de un partido)
     *
     * [goals_team_1 => int, goals_team_2 => int]
     */
    private function normalizeresults(array $results): array
    {
        $resultNormalized = [];
        $gameNumber       = 0;
        foreach ($results as $key => $result) {
            if ($key % 2 == 0) {
                $goals = [];
                $goals['goals_team_1'] = $result;
            } else {
                $goals['goals_team_2'] = $result;
                $resultNormalized[$gameNumber] = $goals;
                $gameNumber++;
            }
        }
        return $resultNormalized;
    }
}
