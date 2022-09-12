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
            'Grupo A',
            'Grupo B',
            'Grupo C',
            'Grupo D',
            'Grupo E',
            'Grupo F',
            'Grupo G',
            'Grupo H',
        ];
        foreach ($groups as $group) {
            DB::table('groups')->insert([
                'name' => $group,
            ]);
        }
    }
}
