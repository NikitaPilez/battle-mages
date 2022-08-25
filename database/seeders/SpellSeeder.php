<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spells')->insert([
            'name' => 'Мерзопакостный',
            'description' => 'Тестовое описание',
            'key' => 'merzopakostniy',
            'image' => 'sdf',
            'mark' => 'sdf',
            'type' => 'sdf',
            'repeat' => 5
        ]);

        DB::table('spells')->insert([
            'name' => 'От инколдуньи',
            'description' => 'Тестовое описание',
            'key' => 'ot-inkolduni',
            'image' => 'sdf',
            'mark' => 'sdf',
            'type' => 'sdf',
            'repeat' => 5
        ]);

        DB::table('spells')->insert([
            'name' => 'Злак маньяк',
            'description' => 'Тестовое описание',
            'key' => 'zlak-manyak',
            'image' => 'sdf',
            'mark' => 'sdf',
            'type' => 'sdf',
            'repeat' => 5
        ]);

        DB::table('spells')->insert([
            'name' => 'Потрошок за пяточок',
            'description' => 'Тестовое описание',
            'key' => 'potroshok-za-pyatochok',
            'image' => 'sdf',
            'mark' => 'sdf',
            'type' => 'sdf',
            'repeat' => 5
        ]);

        DB::table('spells')->insert([
            'name' => 'Аналгилятор',
            'description' => 'Тестовое описание',
            'key' => 'analgilyator',
            'image' => 'sdf',
            'mark' => 'sdf',
            'type' => 'sdf',
            'repeat' => 5
        ]);
    }
}
