<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('purchases')->insert([
            [
                'purchase_id' => 1,
                'user_id' => 2,
                'total' => 3498,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purchase_id' => 2,
                'user_id' => 2,
                'total' => 2999,


                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purchase_id' => 3,
                'user_id' => 3,
                'total' => 2999,


                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
