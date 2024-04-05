<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->insert([
            [
                'news_id' => 1,
                'title' => 'Revolucionaria Técnica de Estampado',
                'lead' => 'Una innovación transforma la moda con estampados de alta definición. ',
                'text' => 'En el corazón de la industria textil, surge una técnica vanguardista que redefine el estándar de calidad en estampado de remeras. Con una combinación única de tintas especiales y maquinaria de última generación, esta innovación no solo ofrece colores vibrantes y precisos, sino también una resistencia al lavado que desafía cualquier expectativa. Diseñadores y amantes de la moda están ansiosos por adoptar esta revolucionaria forma de expresión, anticipando una nueva era en la vestimenta personalizada.',
                'image' => 'imgs/news-01.png',
                'image_small' => 'imgs/news-01.png',
                'image_description' => 'Estampado de vinilo textil de color negro sobre tela blanca deportiva',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'news_id' => 2,
                'title' => 'Rendimiento Redefinido',
                'lead' => 'Explora la revolución en comodidad y rendimiento con nuestra última línea de tejidos técnicos.',
                'text' => 'Hemos elevado el juego con nuestra nueva colección de ropa deportiva. Desde tejidos que absorben la humedad hasta ventilación estratégica, cada prenda está diseñada para maximizar tu rendimiento y comodidad. ¡Prepárate para superar tus límites con estilo y funcionalidad inigualables!',
                'image' => 'imgs/news-02.png',
                'image_small' => 'imgs/news-02.png',
                'image_description' => 'Hombre corriendo entre las montañas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'news_id' => 3,
                'title' => 'Estilo en Movimiento',
                'lead' => 'Abraza la fusión de moda y funcionalidad con nuestro nuevo streetwear deportivo.',
                'text' => 'Desde las calles hasta el gimnasio, nuestra última colección fusiona la estética urbana con características deportivas de alto rendimiento. Tejidos transpirables, detalles de vanguardia y un toque de actitud callejera. ¡Explora la nueva ola de moda deportiva con nosotros!',
                'image' => 'imgs/news-03.png',
                'image_small' => 'imgs/news-03.png',
                'image_description' => 'Chico en cancha de basquet urbana con buzo blanco sin capucha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'news_id' => 4,
                'title' => 'Un Paso hacia la Sostenibilidad',
                'lead' => 'Descubre nuestra línea de ropa deportiva eco-friendly.',
                'text' => 'En Keep Moving, creemos en un futuro sostenible. Presentamos GreenFit, nuestra línea de prendas deportivas fabricadas con materiales reciclados y procesos eco-friendly. Confort, estilo y un compromiso con el planeta. ¡Únete a nosotros en este viaje verde!',
                'image' => 'imgs/news-04.png',
                'image_small' => 'imgs/news-04.png',
                'image_description' => 'Ciclistas atravezando un bosque',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'news_id' => 5,
                'title' => 'Sin Costuras, Sin Límites',
                'lead' => 'Descubre la revolución de la comodidad con nuestra tecnología seamless.',
                'text' => 'Di adiós a las molestias y abraza la libertad de movimiento. Nuestra tecnología seamless elimina las costuras incómodas, brindándote una experiencia sin restricciones. Desde entrenamientos intensos hasta momentos de relajación, cada prenda se adapta a tu cuerpo de manera perfecta. ¡Experimenta la comodidad sin compromisos!',
                'image' => 'imgs/news-05.png',
                'image_small' => 'imgs/news-05.png',
                'image_description' => 'Remera deportiva sin costuras con tela neoprene',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
