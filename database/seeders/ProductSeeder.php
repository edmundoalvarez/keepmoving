<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            
            [
                'product_id' => 1,
                'name' => 'Remera deportiva',
                'price' => 1999,
                'description' => 'Remera deportiva drifit ideal para realizar deporte al aire libre.',
                'image' => 'imgs/product-01.png' ,
                'image_small' => 'imgs/product-01.png',
                'image_description' => 'Remera negra deportiva drifit',
                'color_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'name' => 'Shorts de Entrenamiento',
                'price' => 1499,
                'description' => 'Shorts diseñados para brindar comodidad y libertad de movimiento durante tus entrenamientos intensivos.',
                'image' => 'imgs/product-02.png',
                'image_small' => 'imgs/product-02.png',
                'image_description' => 'Short de entrenamiento de color violeta',
                'color_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'name' => 'Zapatillas de Running',
                'price' => 2999,
                'description' => 'Zapatillas diseñadas para ofrecer un rendimiento óptimo y amortiguación durante tus carreras diarias.',
                'image' => 'imgs/product-03.png',
                'image_small' => 'imgs/product-03.png',
                'image_description' => 'Zapatillas de running negras',
                'color_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4,
                'name' => 'Chaqueta Deportiva Resistente al Viento',
                'price' => 2499,
                'description' => 'Chaqueta ligera resistente al viento, perfecta para protegerte durante tus actividades al aire libre.',
                'image' => 'imgs/product-04.png',
                'image_small' => 'imgs/product-04.png',
                'image_description' => 'Chaqueta deportiva blanca',
                'color_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5,
                'name' => 'Leggings de Compresión',
                'price' => 1799,
                'description' => 'Leggings de compresión que brindan soporte muscular y mejoran la circulación durante tus entrenamientos.',
                'image' => 'imgs/product-05.png',
                'image_small' => 'imgs/product-05.png',
                'image_description' => 'Leggings blancos ',
                'color_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6,
                'name' => 'Gorra Deportiva Transpirable',
                'price' => 899,
                'description' => 'Gorra deportiva con diseño transpirable para mantenerte fresco mientras practicas tus deportes favoritos.',
                'image' => 'imgs/product-06.png',
                'image_small' => 'imgs/product-06.png',
                'image_description' => 'Gorra negra deportiva transpirable',
                'color_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}
