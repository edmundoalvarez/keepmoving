<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carts')->insert([
            [
                'cart_id' => 1,
                'total' => 0,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cart_id' => 2,
                'total' => 0,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cart_id' => 3,
                'total' => 0,

                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
