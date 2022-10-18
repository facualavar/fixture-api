<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatchdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matchdays = [
            [
                'id'   => 'jornada1',
                'name' => 'Jornada 1'
            ],
            [
                'id'   => 'jornada2',
                'name' => 'Jornada 2'
            ],
            [
                'id'   => 'jornada3',
                'name' => 'Jornada 3'
            ],
            [
                'id'   => 'octavos',
                'name' => 'Octavos'
            ],
            [
                'id'   => 'cuartos',
                'name' => 'Cuartos'
            ],
            [
                'id'   => 'semis',
                'name' => 'Semis'
            ],
            [
                'id'   => 'final',
                'name' => 'Final'
            ],
        ];
        foreach ($matchdays as $matchday) {
            DB::table('matchdays')->insert([
                'id' => $matchday['id'],
                'name' => $matchday['name'],
            ]);
        }
    }
}
