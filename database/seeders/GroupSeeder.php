<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'id'   => 'GRUPO_A',
                'name' => 'Grupo A',
            ],
            [
                'id'   => 'GRUPO_B',
                'name' => 'Grupo B',
            ],
            [
                'id'   => 'GRUPO_C',
                'name' => 'Grupo C',
            ],
            [
                'id'   => 'GRUPO_D',
                'name' => 'Grupo D',
            ],
            [
                'id'   => 'GRUPO_E',
                'name' => 'Grupo E',
            ],
            [
                'id'   => 'GRUPO_F',
                'name' => 'Grupo F',
            ],
            [
                'id'   => 'GRUPO_G',
                'name' => 'Grupo G',
            ],
            [
                'id'   => 'GRUPO_H',
                'name' => 'Grupo H',
            ],
        ];
        foreach ($groups as $group) {
            DB::table('groups')->insert([
                'name' => $group,
            ]);
        }
    }
}
