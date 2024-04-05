<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CartSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(PurchaseSeeder::class);
        $this->call(PurchaseHaveProductSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(CartHaveProductSeeder::class);
    }
}
