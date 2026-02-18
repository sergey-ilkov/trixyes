<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // php artisan db:seed --class=ServiceSeeder


        // ? создание 30 сервисов
        $categories = ServiceCategory::all();

        $num = 1;
        for ($i = 0; $i < 30; $i++) {


            $service = Service::create([

                'name' => [
                    'es' => $num . ' Servicio de Ucrania',
                    // 'uk' => $num . ' Сервіс України',
                    // 'ru' => $num . ' Сервис Украины',
                ],

                'icon' => 'images/services/credit-kasa.png',
                'alt_image' => 'Alt image',
                'interset' => round((rand(0, 10) / 100), 2),
                'term' => rand(3, 9) * 10,
                'amount' => rand(1, 10) * 10000,
                'promo_code' => promocodeGenerator(),
                'promo_discount' => rand(1, 10) * 10,
                'vote_rating' => rand(1, 10),
                'vote_count' => rand(10, 1000),
                'url' => 'https://laravel.com/docs/11.x',


                'license' => [
                    'es' => 'Certificado No.' . rand(10000, 100000),
                    // 'uk' => 'Свідотцтво №' . rand(10000, 100000),
                    // 'ru' => 'Свидетельство №' . fake()->randomNumber(9),
                ],


                'comp_name' => [
                    'es' => 'Kyivstar',
                    // 'uk' => 'Київстар',
                    // 'ru' => 'Киевстар',
                ],

                'email' => 'test' . $num . '@test.com',


                'address' => [
                    'es' => 'Kyiv, calle Dniprovska Naberezhna, 19-b',
                    // 'uk' => 'Київ, вул. Дніпровська набережна, 19-б',
                    // 'ru' => 'Киев, ул. Днепровская набережная, 19-б',
                ],

                'phone' => '+38095' . rand(1000000, 10000000),
                'published' => rand(0, 1) == 1,
            ]);

            foreach ($categories as $category) {

                $service->serviceCategories()->attach($category->id, ['rating' => rand(0, 100) / 10]);
            }

            $num += 1;
        }
    }
}