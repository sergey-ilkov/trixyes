<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // ? создание категорий для сервисов
        $categories = [
            [

                'name' => [
                    'es' => 'Mejor ranking',
                    // 'uk' => 'Кращий рейтинг',
                    // 'ru' => 'Лучший рейтинг',
                ],
                'title' => [
                    'es' => 'T-Ranking de servicios de préstamos',
                    // 'uk' => 'T-рейтинг кредитних сервісів',
                    // 'ru' => 'T-рейтинг кредитных сервисов',
                ],
                'description' => [
                    'es' => '<p>El Ranking T se actualiza constantemente mediante inteligencia artificial basándose en múltiples factores (como la tasa de aprobación de solicitudes, el tiempo de decisión, el costo del préstamo, las opiniones de los clientes y la popularidad del servicio)</p>',
                    // 'uk' => '<p>T-рейтинг постійно оновлюється штучним інтелектом на основі багатьох факторів (таких як рівень погодження заявок, час прийняття рішення, вартість кредиту, відгуки позичальників та популярність сервісу)</p>',
                    // 'ru' => '<p>T-рейтинг постоянно обновляется искусственным интеллектом на основе многих факторов (таких как согласование заявок, время принятия решения, стоимость кредита, отзывы заемщиков и популярность сервиса)</p>',
                ],
                'slug' => 'f-rating',
            ],
            [

                'name' => [
                    'es' => 'Mayor aprobación',
                    // 'uk' => 'Краще схвалення',
                    // 'ru' => 'Лучшее одобрение',
                ],
                'title' => [
                    'es' => 'Calificación de aprobación T de servicios de crédito',
                    // 'uk' => 'Рейтинг T-схвалення кредитних сервісів',
                    // 'ru' => 'Рейтинг T-одобрения кредитных сервисов',
                ],
                'description' => [
                    'es' => '<p>Una puntuación de aprobación T alta significa una alta probabilidad de aprobación del préstamo.</p>',
                    // 'uk' => '<p>Високий показник T-схвалення означає високу вирогідність погодження кредиту</p>',
                    // 'ru' => '<p>Высокий показатель T-одобрения означает высокую вероятность согласования кредита</p>',
                ],
                'slug' => 'f-approve',
            ],
            [

                'name' => [
                    'uk' => 'Mejor costo',
                    // 'uk' => 'Краща вартість',
                    // 'ru' => 'Лучшая стоимость',
                ],
                'title' => [
                    'uk' => 'Calificación de servicios crediticios de costo T',
                    // 'uk' => 'Рейтинг T-вартість кредитних сервісів',
                    // 'ru' => 'Рейтинг T-стоимость кредитных сервисов',
                ],
                'description' => [
                    'uk' => '<p>Un valor T alto significa que el servicio de préstamo tiene tasas de interés más bajas.</p>',
                    // 'uk' => '<p>Високий показник T-варість означає кредитний сервіс має менші відсоткові ставки</p>',
                    // 'ru' => '<p>Высокий показатель T-варость означает кредитный сервис имеет меньшие процентные ставки</p>',
                ],
                'slug' => 'f-cost',
            ],
        ];

        foreach ($categories as $category) {
            $data = [
                'name' => $category['name'],
                'title' => $category['title'],
                'description' => $category['description'],
                'slug' => $category['slug'],
            ];

            ServiceCategory::create($data);
        }
    }
}