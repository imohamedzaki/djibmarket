<?php

namespace Database\Seeders;

use App\Models\AdsCompany;
use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdsCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sellers = Seller::where('status', 'active')->get();

        $adsCompanies = [
            [
                'name' => 'Microsoft',
                'link' => 'https://microsoft.com',
                'start_date' => now()->subDays(10),
                'end_date' => now()->addDays(30),
                'seller_id' => $sellers->count() > 0 ? $sellers->random()->id : null,
                'is_active' => true,
            ],
            [
                'name' => 'Sony Corporation',
                'link' => 'https://sony.com',
                'start_date' => now()->subDays(5),
                'end_date' => now()->addDays(45),
                'seller_id' => $sellers->count() > 0 ? $sellers->random()->id : null,
                'is_active' => true,
            ],
            [
                'name' => 'Acer Inc.',
                'link' => 'https://acer.com',
                'start_date' => now()->addDays(5),
                'end_date' => now()->addDays(60),
                'seller_id' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Nokia',
                'link' => 'https://nokia.com',
                'start_date' => now()->subDays(30),
                'end_date' => now()->subDays(5),
                'seller_id' => $sellers->count() > 0 ? $sellers->random()->id : null,
                'is_active' => true,
            ],
            [
                'name' => 'ASUS',
                'link' => 'https://asus.com',
                'start_date' => now()->subDays(2),
                'end_date' => now()->addDays(20),
                'seller_id' => $sellers->count() > 0 ? $sellers->random()->id : null,
                'is_active' => false,
            ],
        ];

        foreach ($adsCompanies as $adsCompanyData) {
            AdsCompany::create($adsCompanyData);
        }
    }
}
