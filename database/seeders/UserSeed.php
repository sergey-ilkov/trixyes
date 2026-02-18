<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $date = Carbon::create(2010, 1, 10, 9, 0, 0);
        $num = 10;
        for ($i = 0; $i < 5; $i++) {
            $newDate = $date->addWeeks(rand(1, 52))->format('Y-m-d H:i:s');

            $data = [
                'name' => fake()->firstName(),
                'surname' => fake()->lastName(),
                'birthday' => $newDate,
                'phone' => fake()->phoneNumber() . $i,
                'email' => $i . fake()->email(),
                'password' => bcrypt('123'),
                'id_unique' => $num . uniqid(),

            ];

            User::create($data);

            $num += 1;
        }
    }
}