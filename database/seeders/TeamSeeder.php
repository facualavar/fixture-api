<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'name'     => 'Qatar',
                'icon'     => 'https://flagcdn.com/w20/qa.png',
                'group_id' => 1
            ],
            [
                'name'     => 'Ecuador',
                'icon'     => 'https://flagcdn.com/w20/ec.png',
                'group_id' => 1
            ],
            [
                'name'     => 'Senegal',
                'icon'     => 'https://flagcdn.com/w20/sn.png',
                'group_id' => 1
            ],
            [
                'name'     => 'Países Bajos',
                'icon'     => 'https://flagcdn.com/w20/nl.png',
                'group_id' => 1
            ],
            [
                'name'     => 'Inglaterra',
                'icon'     => 'https://flagcdn.com/w20/gb-eng.png',
                'group_id' => 2
            ],
            [
                'name'     => 'Irán',
                'icon'     => 'https://flagcdn.com/w20/ir.png',
                'group_id' => 2
            ],
            [
                'name'     => 'Estado Unidos',
                'icon'     => 'https://flagcdn.com/w20/us.png',
                'group_id' => 2
            ],
            [
                'name'     => 'Gales',
                'icon'     => 'https://flagcdn.com/w20/gb-wls.png',
                'group_id' => 2
            ],
            [
                'name'     => 'Argentina',
                'icon'     => 'https://flagcdn.com/w20/ar.png',
                'group_id' => 3
            ],
            [
                'name'     => 'Arabia Saudita',
                'icon'     => 'https://flagcdn.com/w20/sa.png',
                'group_id' => 3
            ],
            [
                'name'     => 'Mexico',
                'icon'     => 'https://flagcdn.com/w20/mx.png',
                'group_id' => 3
            ],
            [
                'name'     => 'Polonia',
                'icon'     => 'https://flagcdn.com/w20/pl.png',
                'group_id' => 3
            ],
            [
                'name'     => 'Francia',
                'icon'     => 'https://flagcdn.com/w20/fr.png',
                'group_id' => 4
            ],
            [
                'name'     => 'Australia',
                'icon'     => 'https://flagcdn.com/w20/au.png',
                'group_id' => 4
            ],
            [
                'name'     => 'Dinamarca',
                'icon'     => 'https://flagcdn.com/w20/dk.png',
                'group_id' => 4
            ],
            [
                'name'     => 'Túnez',
                'icon'     => 'https://flagcdn.com/w20/tn.png',
                'group_id' => 4
            ],
            [
                'name'     => 'España',
                'icon'     => 'https://flagcdn.com/w20/es.png',
                'group_id' => 5
            ],
            [
                'name'     => 'Costa Rica',
                'icon'     => 'https://flagcdn.com/w20/cr.png',
                'group_id' => 5
            ],
            [
                'name'     => 'Alemania',
                'icon'     => 'https://flagcdn.com/w20/de.png',
                'group_id' => 5
            ],
            [
                'name'     => 'Japón',
                'icon'     => 'https://flagcdn.com/w20/jp.png',
                'group_id' => 5
            ],
            [
                'name'     => 'Bélgica',
                'icon'     => 'https://flagcdn.com/w20/be.png',
                'group_id' => 6
            ],
            [
                'name'     => 'Canadá',
                'icon'     => 'https://flagcdn.com/w20/ca.png',
                'group_id' => 6
            ],
            [
                'name'     => 'Marruecos',
                'icon'     => 'https://flagcdn.com/w20/ma.png',
                'group_id' => 6
            ],
            [
                'name'     => 'Croacia',
                'icon'     => 'https://flagcdn.com/w20/hr.png',
                'group_id' => 6
            ],
            [
                'name'     => 'Brasil',
                'icon'     => 'https://flagcdn.com/w20/br.png',
                'group_id' => 7
            ],
            [
                'name'     => 'Serbia',
                'icon'     => 'https://flagcdn.com/w20/rs.png',
                'group_id' => 7
            ],
            [
                'name'     => 'Suiza',
                'icon'     => 'https://flagcdn.com/w20/ch.png',
                'group_id' => 7
            ],
            [
                'name'     => 'Camerún',
                'icon'     => 'https://flagcdn.com/w20/cm.png',
                'group_id' => 7
            ],
            [
                'name'     => 'Portugal',
                'icon'     => 'https://flagcdn.com/w20/pt.png',
                'group_id' => 8
            ],
            [
                'name'     => 'Ghana',
                'icon'     => 'https://flagcdn.com/w20/gh.png',
                'group_id' => 8
            ],
            [
                'name'     => 'Uruguay',
                'icon'     => 'https://flagcdn.com/w20/uy.png',
                'group_id' => 8
            ],
            [
                'name'     => 'Corea del Sur',
                'icon'     => 'https://flagcdn.com/w20/kr.png',
                'group_id' => 8
            ],
        ];

        foreach ($teams as $team) {
            DB::table('teams')->insert($team);
        }
    }
}
