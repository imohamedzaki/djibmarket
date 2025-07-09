<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationBar;
use App\Models\NotificationBarColumn;
use Carbon\Carbon;

class NotificationBarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default notification bar with current content
        $notificationBar = NotificationBar::create([
            'name' => 'Default Promotional Banner',
            'column_count' => 3,
            'start_date' => Carbon::now()->subDays(30),
            'end_date' => Carbon::now()->addDays(365),
            'is_active' => true,
            'css_class' => 'box-notify',
        ]);

        // Create the three columns with current content
        $columns = [
            [
                'column_order' => 1,
                'text_content' => 'Save 20% on your first order. Code: DMarket',
                'image_path' => null,
                'link_url' => null,
                'link_target' => '_self',
                'is_active' => true,
            ],
            [
                'column_order' => 2,
                'text_content' => 'Premium brand products for an affordable price',
                'image_path' => null,
                'link_url' => null,
                'link_target' => '_self',
                'is_active' => true,
            ],
            [
                'column_order' => 3,
                'text_content' => 'Free exchange of products within 30 days',
                'image_path' => null,
                'link_url' => null,
                'link_target' => '_self',
                'is_active' => true,
            ],
        ];

        foreach ($columns as $columnData) {
            $notificationBar->columns()->create($columnData);
        }

        // Create another example notification bar with different configuration
        $promoBar = NotificationBar::create([
            'name' => 'Holiday Special Promotion',
            'column_count' => 2,
            'start_date' => Carbon::now()->addDays(7),
            'end_date' => Carbon::now()->addDays(37),
            'is_active' => false, // Scheduled for future
            'css_class' => 'box-notify holiday-special',
        ]);

        $promoColumns = [
            [
                'column_order' => 1,
                'text_content' => 'Holiday Sale: Up to 50% off all items!',
                'image_path' => 'images/holiday-icon.png',
                'link_url' => '/holiday-sale',
                'link_target' => '_self',
                'is_active' => true,
            ],
            [
                'column_order' => 2,
                'text_content' => 'Free shipping on orders over $100',
                'image_path' => 'images/shipping-icon.png',
                'link_url' => '/shipping-info',
                'link_target' => '_blank',
                'is_active' => true,
            ],
        ];

        foreach ($promoColumns as $columnData) {
            $promoBar->columns()->create($columnData);
        }
    }
}
