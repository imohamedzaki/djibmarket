<?php

namespace Database\Seeders;

use App\Models\BusinessActivity;
use App\Models\Seller;
use App\Models\SellerDocument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch a few business activities to assign to sellers
        $businessActivities = BusinessActivity::inRandomOrder()->limit(3)->get();

        if ($businessActivities->isEmpty()) {
            $this->command->warn('No business activities found. Please run BusinessActivitySeeder first.');
            // Optionally create a default one if needed
            // $defaultActivity = BusinessActivity::firstOrCreate(['name' => 'General Retail']);
            // $businessActivities = collect([$defaultActivity]);
            return; // Stop seeding if no activities are available
        }

        // Create a specific seller for testing/demo purposes
        $specificSeller = Seller::factory()->create([
            'name' => 'Mohamed Zaki',
            'email' => 'miiido.zaki@gmail.com',
            'password' => Hash::make('test'), // Hash the password
            'business_activity_id' => $businessActivities->random()->id,
        ]);

        // Create documents for the specific seller
        SellerDocument::factory(2)->create([
            'seller_id' => $specificSeller->id,
        ]);


        // Create multiple additional sellers using the factory
        Seller::factory(4)->make()->each(function ($seller) use ($businessActivities) {
            // Assign a random business activity
            $seller->business_activity_id = $businessActivities->random()->id;
            $seller->save(); // Save the seller first to get an ID

            // Create related seller documents for each seller
            SellerDocument::factory(mt_rand(1, 3))->create([ // Create 1 to 3 documents
                'seller_id' => $seller->id, // Assign the seller_id
            ]);
        });
    }
}