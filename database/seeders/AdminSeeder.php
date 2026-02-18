<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            'login' => 'superadmin',
            'password' => bcrypt('123'),
            'role' => 'superadmin',
        ];


        Admin::create($data);
    }
}