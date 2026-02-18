<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\History;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $date = Carbon::create(2020, 5, 28, 9, 0, 0);


        for ($i = 0; $i < 20; $i++) {

            $newDate = $date->addWeeks(rand(1, 52))->format('Y-m-d H:i:s');
            $data = [
                'service_id' => Service::pluck('id')->random(),
                'user_id' => User::pluck('id')->random(),
                'action_id' => Action::pluck('id')->random(),
                'created_at' => $newDate,
                'updated_at' => $newDate,
            ];

            History::create($data);
        }
    }
}