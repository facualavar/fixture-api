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
                'short_name' => 'Grupos',
                'name' => 'Fase de grupos',
            ],
            [
                'short_name' => '8vos',
                'name' => 'Octavos de final',
            ],
            [
                'short_name' => '4tos',
                'name' => 'Cuartos de final',
            ],
            [
                'short_name' => 'Semis',
                'name' => 'Semifinales',
            ],
            [
                'short_name' => 'Final',
                'name' => 'Final',
            ],
        ];
        foreach ($stages as $stage) {
            DB::table('stages')->insert($stage);
        }
    }
}
