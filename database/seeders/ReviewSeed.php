<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $num = 1;
        for ($i = 0; $i < 6; $i++) {

            $data = [
                'name' => 'Євген',
                'surname' => $num,
                'rating' => rand(1, 10),
                'text' => 'Супер сервіс. Раджу знайомим.',
            ];

            Review::create($data);
            $num += 1;
        }
    }
}