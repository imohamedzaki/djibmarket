<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin; // Assuming the Admin model exists in App\Models

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Mohamed Zaki',
            'email' => 'miiido.zaki@gmail.com',
            'password' => 'test',
            // Add any other required fields for the Admin model here
        ]);
    }
}