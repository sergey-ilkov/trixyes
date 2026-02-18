<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([

            LanguageSeeder::class,
            // ReviewSeed::class,

            ActionSeeder::class,
            // PostSeeder::class,
            ServiceCategorySeeder::class,
            // ServiceSeeder::class,

            // UserSeed::class,

            // HistorySeeder::class,
            // AdminSeeder::class,

        ]);
    }
}