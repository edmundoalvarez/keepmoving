<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseHaveProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('purchases_have_products')->insert([
            [
                'purchase_id' => 1,
                'product_id' => 1,
                'quantity' => 1,
                'subtotal' => 1999,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purchase_id' => 1,
                'product_id' => 2,
                'quantity' => 1,
                'subtotal' => 1499,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purchase_id' => 2,
                'product_id' => 3,
                'quantity' => 1,
                'subtotal' => 2999,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purchase_id' => 3,
                'product_id' => 3,
                'quantity' => 1,
                'subtotal' => 2999,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
