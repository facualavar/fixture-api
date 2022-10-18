<?php

namespace Database\Seeders;

use Fixture\Infrastructure\Persistence\Eloquent\GroupEloquentModel;
use Fixture\Infrastructure\Persistence\Eloquent\TeamEloquentModel;
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
        $groups = GroupEloquentModel::all();

        foreach ($groups as $group) {
            $teams = TeamEloquentModel::where('group_id', $group->id)->orderBy('order_group')->get();

            $team1 = $teams[0];
            $team2 = $teams[1];
            $team3 = $teams[2];
            $team4 = $teams[3];

            // Fecha 1
            $this->createGame($team1->id, $team2->id, 'grupos', $group->id, 'jornada1');
            $this->createGame($team3->id, $team4->id, 'grupos', $group->id, 'jornada1');

            // Fecha 2
            $this->createGame($team1->id, $team3->id, 'grupos', $group->id, 'jornada2');
            $this->createGame($team2->id, $team4->id, 'grupos', $group->id, 'jornada2');

            // Fecha 3
            $this->createGame($team1->id, $team4->id, 'grupos', $group->id, 'jornada3');
            $this->createGame($team2->id, $team3->id, 'grupos', $group->id, 'jornada3');
        }

        // Octavos de final
        $this->createGame(null, null, 'octavos', null, null);
        $this->createGame(null, null, 'octavos', null, null);
        $this->createGame(null, null, 'octavos', null, null);
        $this->createGame(null, null, 'octavos', null, null);
        $this->createGame(null, null, 'octavos', null, null);
        $this->createGame(null, null, 'octavos', null, null);
        $this->createGame(null, null, 'octavos', null, null);
        $this->createGame(null, null, 'octavos', null, null);

        // Cuartos de final
        $this->createGame(null, null, 'cuartos', null, null);
        $this->createGame(null, null, 'cuartos', null, null);
        $this->createGame(null, null, 'cuartos', null, null);
        $this->createGame(null, null, 'cuartos', null, null);

        // Semifinales
        $this->createGame(null, null, 'final', null, null);
        $this->createGame(null, null, 'final', null, null);

        // Final
        $this->createGame(null, null, 'final', null, null);
    }

    private function createGame(?string $team1, ?string $team2, string $stage, ?string $group, ?string $matchday): void
    {
        DB::table('games')->insert([
            'team_1_id' => $team1,
            'team_2_id' => $team2,
            'stage_id'  => $stage,
            'user_id'   => null,
            'group_id'  => $group,
            'matchday_id' => $matchday,
        ]);
    }
}
