<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stages = [
            [
                'id' => 'grupos',
                'short_name' => 'Grupos',
                'name' => 'Fase de grupos',
            ],
            [
                'id' => 'octavos',
                'short_name' => '8vos',
                'name' => 'Octavos de final',
            ],
            [
                'id' => 'cuartos',
                'short_name' => '4tos',
                'name' => 'Cuartos de final',
            ],
            [
                'id' => 'semis',
                'short_name' => 'Semis',
                'name' => 'Semifinales',
            ],
            [
                'id' => 'final',
                'short_name' => 'Final',
                'name' => 'Final',
            ],
        ];
        foreach ($stages as $stage) {
            DB::table('stages')->insert($stage);
        }
    }
}
