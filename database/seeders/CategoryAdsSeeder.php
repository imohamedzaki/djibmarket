<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryAd;
use Carbon\Carbon;

class CategoryAdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample ad images
        $adImages = [
            'https://images.pexels.com/photos/1080721/pexels-photo-1080721.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/3373739/pexels-photo-3373739.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/235127/pexels-photo-235127.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/163772/boys-children-dolls-kids-163772.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/356056/pexels-photo-356056.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/996329/pexels-photo-996329.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/358070/pexels-photo-358070.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/1552242/pexels-photo-1552242.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/159711/books-bookstore-book-reading-159711.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/416978/pexels-photo-416978.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/4047146/pexels-photo-4047146.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/6238050/pexels-photo-6238050.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
            'https://images.pexels.com/photos/1457847/pexels-photo-1457847.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
        ];

        // Get all super categories (categories with null parent_id)
        $superCategories = Category::whereNull('parent_id')->get();

        $adPosition = 1;

        foreach ($superCategories as $category) {
            // Create 2-4 ads per category to demonstrate slider functionality
            $numberOfAds = rand(2, 4);

            for ($i = 0; $i < $numberOfAds; $i++) {
                $imageIndex = ($adPosition + $i) % count($adImages);

                CategoryAd::create([
                    'category_id' => $category->id,
                    'image_path' => $adImages[$imageIndex],
                    'link_url' => route('categories.show', $category),
                    'position' => $i + 1,
                    'active' => true,
                    'starts_at' => Carbon::now()->subDays(7),
                    'ends_at' => Carbon::now()->addMonths(3),
                ]);
            }

            $adPosition += $numberOfAds;
        }

        $this->command->info('Category ads seeder completed successfully!');
        $this->command->info('Created ads for ' . $superCategories->count() . ' super categories');
    }
}
