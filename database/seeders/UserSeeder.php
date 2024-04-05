<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'user_id' => 1,
                'name' => 'Admin',
                'rol' => 1,
                'email' => 'admin@user.com',
                'password' => Hash::make('asdasd'),
                'cart_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'name' => 'Normal',
                'rol' => 2,
                'email' => 'normal@user.com',
                'password' => Hash::make('asdasd'),
                'cart_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'name' => 'Normal 2',
                'rol' => 2,
                'email' => 'normal2@user.com',
                'password' => Hash::make('asdasd'),
                'cart_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
