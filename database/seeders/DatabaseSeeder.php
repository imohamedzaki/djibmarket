<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            BusinessActivitySeeder::class,
            CategorySeeder::class,
            CategorySeeder2::class,
            SellerSeeder::class,
            AdminSeeder::class,
            SellerAdsSeeder::class,
            TopBrandsSeeder::class,
            CategoryAdsSeeder::class,
        ]);
    }
}
