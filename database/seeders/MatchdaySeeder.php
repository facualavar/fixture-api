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
            'Jornada 1',
            'Jornada 2',
            'Jornada 3',
            'Octavos',
            'Cuartos',
            'Semis',
            'Final',
        ];
        foreach ($matchdays as $matchday) {
            DB::table('matchdays')->insert([
                'name' => $matchday,
            ]);
        }
    }
}
