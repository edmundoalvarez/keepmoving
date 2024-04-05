<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sizes')->insert([
            [
                'size_id' => 1,
                'name' => 'XS',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size_id' => 2,
                'name' => 'S',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size_id' => 3,
                'name' => 'M',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size_id' => 4,
                'name' => 'L',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size_id' => 5,
                'name' => 'XL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size_id' => 6,
                'name' => 'XXL',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size_id' => 7,
                'name' => 'Único',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size_id' => 8,
                'name' => '38',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size_id' => 9,
                'name' => '39',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size_id' => 10,
                'name' => '40',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('products_have_sizes')->insert([
            [
                'product_id' => 1,
                'size_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'size_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'size_id' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 4,
                'size_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 5,
                'size_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 6,
                'size_id' => 7,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 1,
                'size_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 2,
                'size_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 4,
                'size_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 4,
                'size_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'size_id' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
