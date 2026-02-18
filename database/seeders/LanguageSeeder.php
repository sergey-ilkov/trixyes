<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $actions = [
            [
                'name' => 'español',
                'code' => 'es',
            ],
            // [
            //     'name' => 'українська',
            //     'code' => 'uk',
            // ],
            // [
            //     'name' => 'русский',
            //     'code' => 'ru',
            // ],

        ];

        foreach ($actions as $action) {
            $data = [
                'name' => $action['name'],
                'code' => $action['code'],
            ];


            Language::create($data);
        }
    }
}