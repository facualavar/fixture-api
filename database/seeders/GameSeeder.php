<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Matchday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fase de Grupos
        $groups = Group::with('teams')->get();

        foreach ($groups as $group) {
            $teams = $group->teams;

            $team1 = $teams[0];
            $team2 = $teams[1];
            $team3 = $teams[2];
            $team4 = $teams[3];

            // Fecha 1
            $this->createGame($team1->id, $team2->id, 1, $group->id, 1);
            $this->createGame($team3->id, $team4->id, 1, $group->id, 1);

            // Fecha 2
            $this->createGame($team1->id, $team3->id, 1, $group->id, 2);
            $this->createGame($team2->id, $team4->id, 1, $group->id, 2);

            // Fecha 3
            $this->createGame($team1->id, $team4->id, 1, $group->id, 3);
            $this->createGame($team2->id, $team3->id, 1, $group->id, 3);
        }

        // Octavos de final
        $this->createGame(null, null, 2, null, 4);
        $this->createGame(null, null, 2, null, 4);
        $this->createGame(null, null, 2, null, 4);
        $this->createGame(null, null, 2, null, 4);
        $this->createGame(null, null, 2, null, 4);
        $this->createGame(null, null, 2, null, 4);
        $this->createGame(null, null, 2, null, 4);
        $this->createGame(null, null, 2, null, 4);

        // Cuartos de final
        $this->createGame(null, null, 3, null, 5);
        $this->createGame(null, null, 3, null, 5);
        $this->createGame(null, null, 3, null, 5);
        $this->createGame(null, null, 3, null, 5);

        // Semifinales
        $this->createGame(null, null, 4, null, 6);
        $this->createGame(null, null, 4, null, 6);

        // Final
        $this->createGame(null, null, 5, null, 7);
    }

    private function createGame(?int $team1, ?int $team2, int $stage, ?int $group, ?int $matchday): void
    {
        DB::table('games')->insert([
            'team_1_id' => $team1,
            'team_2_id' => $team2,
            'stage_id'  => $stage,
            'group_id'  => $group,
            'matchday_id' => $matchday,
        ]);
    }
}
