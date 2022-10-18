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
                'id'       => 'QAT',
                'name'     => 'Qatar',
                'icon'     => 'https://flagcdn.com/w20/qa.png',
                'group_id' => 1,
                'order_group' => 1
            ],
            [
                'id'       => 'ECU',
                'name'     => 'Ecuador',
                'icon'     => 'https://flagcdn.com/w20/ec.png',
                'group_id' => 1,
                'order_group' => 2
            ],
            [
                'id'       => 'SEN',
                'name'     => 'Senegal',
                'icon'     => 'https://flagcdn.com/w20/sn.png',
                'group_id' => 1,
                'order_group' => 3
            ],
            [
                'id'       => 'NLD',
                'name'     => 'Países Bajos',
                'icon'     => 'https://flagcdn.com/w20/nl.png',
                'group_id' => 1,
                'order_group' => 4
            ],
            [
                'id'       => 'ENG',
                'name'     => 'Inglaterra',
                'icon'     => 'https://flagcdn.com/w20/gb-eng.png',
                'group_id' => 2,
                'order_group' => 1
            ],
            [
                'id'       => 'IRN',
                'name'     => 'Irán',
                'icon'     => 'https://flagcdn.com/w20/ir.png',
                'group_id' => 2,
                'order_group' => 2
            ],
            [
                'id'       => 'USA',
                'name'     => 'Estado Unidos',
                'icon'     => 'https://flagcdn.com/w20/us.png',
                'group_id' => 2,
                'order_group' => 3
            ],
            [
                'id'       => 'WAL',
                'name'     => 'Gales',
                'icon'     => 'https://flagcdn.com/w20/gb-wls.png',
                'group_id' => 2,
                'order_group' => 4
            ],
            [
                'id'       => 'ARG',
                'name'     => 'Argentina',
                'icon'     => 'https://flagcdn.com/w20/ar.png',
                'group_id' => 3,
                'order_group' => 1
            ],
            [
                'id'       => 'SAU',
                'name'     => 'Arabia Saudita',
                'icon'     => 'https://flagcdn.com/w20/sa.png',
                'group_id' => 3,
                'order_group' => 2
            ],
            [
                'id'       => 'MEX',
                'name'     => 'Mexico',
                'icon'     => 'https://flagcdn.com/w20/mx.png',
                'group_id' => 3,
                'order_group' => 3
            ],
            [
                'id'       => 'POL',
                'name'     => 'Polonia',
                'icon'     => 'https://flagcdn.com/w20/pl.png',
                'group_id' => 3,
                'order_group' => 4
            ],
            [
                'id'       => 'FRA',
                'name'     => 'Francia',
                'icon'     => 'https://flagcdn.com/w20/fr.png',
                'group_id' => 4,
                'order_group' => 1
            ],
            [
                'id'       => 'AUS',
                'name'     => 'Australia',
                'icon'     => 'https://flagcdn.com/w20/au.png',
                'group_id' => 4,
                'order_group' => 2
            ],
            [
                'id'       => 'DNK',
                'name'     => 'Dinamarca',
                'icon'     => 'https://flagcdn.com/w20/dk.png',
                'group_id' => 4,
                'order_group' => 3
            ],
            [
                'id'       => 'TUN',
                'name'     => 'Túnez',
                'icon'     => 'https://flagcdn.com/w20/tn.png',
                'group_id' => 4,
                'order_group' => 4
            ],
            [
                'id'       => 'ESP',
                'name'     => 'España',
                'icon'     => 'https://flagcdn.com/w20/es.png',
                'group_id' => 5,
                'order_group' => 1
            ],
            [
                'id'       => 'CRI',
                'name'     => 'Costa Rica',
                'icon'     => 'https://flagcdn.com/w20/cr.png',
                'group_id' => 5,
                'order_group' => 2
            ],
            [
                'id'       => 'DEU',
                'name'     => 'Alemania',
                'icon'     => 'https://flagcdn.com/w20/de.png',
                'group_id' => 5,
                'order_group' => 3
            ],
            [
                'id'       => 'JPN',
                'name'     => 'Japón',
                'icon'     => 'https://flagcdn.com/w20/jp.png',
                'group_id' => 5,
                'order_group' => 4
            ],
            [
                'id'       => 'BEL',
                'name'     => 'Bélgica',
                'icon'     => 'https://flagcdn.com/w20/be.png',
                'group_id' => 6,
                'order_group' => 1
            ],
            [
                'id'       => 'CAN',
                'name'     => 'Canadá',
                'icon'     => 'https://flagcdn.com/w20/ca.png',
                'group_id' => 6,
                'order_group' => 2
            ],
            [
                'id'       => 'MAR',
                'name'     => 'Marruecos',
                'icon'     => 'https://flagcdn.com/w20/ma.png',
                'group_id' => 6,
                'order_group' => 3
            ],
            [
                'id'       => 'HRV',
                'name'     => 'Croacia',
                'icon'     => 'https://flagcdn.com/w20/hr.png',
                'group_id' => 6,
                'order_group' => 4
            ],
            [
                'id'       => 'BRA',
                'name'     => 'Brasil',
                'icon'     => 'https://flagcdn.com/w20/br.png',
                'group_id' => 7,
                'order_group' => 1
            ],
            [
                'id'       => 'SER',
                'name'     => 'Serbia',
                'icon'     => 'https://flagcdn.com/w20/rs.png',
                'group_id' => 7,
                'order_group' => 2
            ],
            [
                'id'       => 'CHE',
                'name'     => 'Suiza',
                'icon'     => 'https://flagcdn.com/w20/ch.png',
                'group_id' => 7,
                'order_group' => 3
            ],
            [
                'id'       => 'CMR',
                'name'     => 'Camerún',
                'icon'     => 'https://flagcdn.com/w20/cm.png',
                'group_id' => 7,
                'order_group' => 4
            ],
            [
                'id'       => 'PRT',
                'name'     => 'Portugal',
                'icon'     => 'https://flagcdn.com/w20/pt.png',
                'group_id' => 8,
                'order_group' => 1
            ],
            [
                'id'       => 'GHA',
                'name'     => 'Ghana',
                'icon'     => 'https://flagcdn.com/w20/gh.png',
                'group_id' => 8,
                'order_group' => 2
            ],
            [
                'id'       => 'URY',
                'name'     => 'Uruguay',
                'icon'     => 'https://flagcdn.com/w20/uy.png',
                'group_id' => 8,
                'order_group' => 3
            ],
            [
                'id'       => 'KOR',
                'name'     => 'Corea del Sur',
                'icon'     => 'https://flagcdn.com/w20/kr.png',
                'group_id' => 8,
                'order_group' => 4
            ],
        ];

        foreach ($teams as $team) {
            DB::table('teams')->insert($team);
        }
    }
}
