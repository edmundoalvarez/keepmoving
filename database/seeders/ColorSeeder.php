<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colors')->insert([
            [
                'color_id' => 1,
                'name' => 'Blanco',
            ],
            [
                'color_id' => 2,
                'name' => 'Negro',
            ],
            [
                'color_id' => 3,
                'name' => 'Gris',
            ],
            [
                'color_id' => 4,
                'name' => 'Violeta',
            ],
            [
                'color_id' => 5,
                'name' => 'Azul',
            ],
            [
                'color_id' => 6,
                'name' => 'Rojo',
            ],
            [
                'color_id' => 7,
                'name' => 'Naranja',
            ],
            [
                'color_id' => 8,
                'name' => 'Amarillo',
            ]
        ]);
    }
}
