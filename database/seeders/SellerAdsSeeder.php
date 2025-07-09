<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SellerAd;
use Carbon\Carbon;

class SellerAdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Main Banner Slider Ads (4 slides) - Main Banner Section
        $mainBannerAds = [
            [
                'title' => 'Special Offers - Huge Discounts',
                'description' => 'Get up to 50% off on your first purchases',
                'ad_slot' => 'ads_space_1_main_banner',
                'headline' => 'Huge discounts on your first purchases',
                'sub_headline' => 'Use discount code at checkout and get instant savings.',
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/banner.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-blue',
                    'label_class' => 'label-green',
                    'label_text' => 'new offers'
                ])
            ],
            [
                'title' => 'Mega Sale - Limited Offers',
                'description' => 'Exclusive deals for limited time only',
                'ad_slot' => 'ads_space_1_main_banner',
                'headline' => 'Exclusive deals for limited time only',
                'sub_headline' => 'Save up to 75% on selected products.',
                'call_to_action_text' => 'Discover Deals',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/banner.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-purple',
                    'label_class' => 'label-blue',
                    'label_text' => 'mega sale'
                ])
            ],
            [
                'title' => 'Best Sellers - Premium Products',
                'description' => 'High quality products at unbeatable prices',
                'ad_slot' => 'ads_space_1_main_banner',
                'headline' => 'High quality products at amazing prices',
                'sub_headline' => 'Discover our most popular items today.',
                'call_to_action_text' => 'Explore Products',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/banner.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-green',
                    'label_class' => 'label-orange',
                    'label_text' => 'best sellers'
                ])
            ],
            [
                'title' => 'Luxury Collection - Premium Items',
                'description' => 'Luxury products for distinguished customers',
                'ad_slot' => 'ads_space_1_main_banner',
                'headline' => 'Luxury products for distinguished customers',
                'sub_headline' => 'Enjoy premium shopping experience with finest products.',
                'call_to_action_text' => 'Shop Luxury',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/banner.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-coral',
                    'label_class' => 'label-purple',
                    'label_text' => 'luxury collection'
                ])
            ]
        ];

        // Weekly Deal Slider Ads (4 slides) - Weekly Offers Section
        $weeklyDealAds = [
            [
                'title' => 'New Arrivals - Deal of the Week',
                'description' => 'Deal of the Week - Save up to 45,000 DJF',
                'ad_slot' => 'ads_space_1_weekly_deal',
                'headline' => 'Deal of the Week',
                'sub_headline' => 'Save up to 45,000 DJF',
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/weekly.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-lavender',
                    'label_text' => 'New Arrivals'
                ])
            ],
            [
                'title' => 'Hot Deals - Flash Sale',
                'description' => 'Flash Sale - Save up to 32,000 DJF today',
                'ad_slot' => 'ads_space_1_weekly_deal',
                'headline' => 'Flash Sale',
                'sub_headline' => 'Save up to 32,000 DJF today',
                'call_to_action_text' => 'Get It Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/weekly.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-mint',
                    'label_text' => 'Hot Deals'
                ])
            ],
            [
                'title' => 'Huge Sale - End of Season',
                'description' => 'End of Season - Save up to 62,000 DJF',
                'ad_slot' => 'ads_space_1_weekly_deal',
                'headline' => 'End of Season',
                'sub_headline' => 'Save up to 62,000 DJF',
                'call_to_action_text' => 'Don\'t Miss',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/weekly.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-peach',
                    'label_text' => 'Huge Sale'
                ])
            ],
            [
                'title' => 'Special Offer - Bundle Deal',
                'description' => 'Bundle Deal - Save up to 35,000 DJF extra',
                'ad_slot' => 'ads_space_1_weekly_deal',
                'headline' => 'Bundle Deal',
                'sub_headline' => 'Save up to 35,000 DJF extra',
                'call_to_action_text' => 'Buy Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/weekly.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-sky',
                    'label_text' => 'Special Offer'
                ])
            ]
        ];

        // Tech Products Slider Ads (4 slides) - Tech Products Section
        $techProductsAds = [
            [
                'title' => 'Laptops 2024 - Certified Deals',
                'description' => 'Certified deals on 2024 Laptops',
                'ad_slot' => 'ads_space_1_tech_products',
                'headline' => 'Certified deals on 2024 Laptops',
                'sub_headline' => null,
                'call_to_action_text' => 'Discover More',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/certify.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-cream',
                    'label_text' => 'New Arrivals'
                ])
            ],
            [
                'title' => 'Smart Phones - Premium Collection',
                'description' => 'Premium smartphone collection with latest technology',
                'ad_slot' => 'ads_space_1_tech_products',
                'headline' => 'Premium smartphone collection',
                'sub_headline' => null,
                'call_to_action_text' => 'Browse Phones',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/certify.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-rose',
                    'label_text' => 'Latest Tech'
                ])
            ],
            [
                'title' => 'Gaming Devices - For Professionals',
                'description' => 'Professional gaming devices available now',
                'ad_slot' => 'ads_space_1_tech_products',
                'headline' => 'Professional gaming devices available',
                'sub_headline' => null,
                'call_to_action_text' => 'For Gaming',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/certify.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-sage',
                    'label_text' => 'Gaming Zone'
                ])
            ],
            [
                'title' => 'Professional Workstations - For Business',
                'description' => 'Professional workstation deals',
                'ad_slot' => 'ads_space_1_tech_products',
                'headline' => 'Professional workstation deals',
                'sub_headline' => null,
                'call_to_action_text' => 'For Business',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/certify.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-soft-powder',
                    'label_text' => 'Business Class'
                ])
            ]
        ];

        // Ads Space 2 - Power Bank Section
        $powerBankAds = [
            [
                'title' => 'Power Bank - Quick Charge',
                'description' => 'Lightweight and Portable Dual port fast charge',
                'ad_slot' => 'ads_space_2_power_bank',
                'headline' => 'Quick Charge',
                'sub_headline' => 'Lightweight and Portable Dual port fast charge',
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/banner.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-4',
                    'label_text' => 'Power Bank'
                ])
            ],
            [
                'title' => 'Wireless Charger - Fast Charging',
                'description' => 'Wireless fast charging technology',
                'ad_slot' => 'ads_space_2_power_bank',
                'headline' => 'Wireless Fast Charging',
                'sub_headline' => 'Compatible with all devices Latest charging technology',
                'call_to_action_text' => 'Discover More',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/banner.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-4',
                    'label_text' => 'Wireless Tech'
                ])
            ]
        ];

        // Ads Space 2 - Game Controller Section  
        $gameControllerAds = [
            [
                'title' => 'Xbox Series XS Game Controller',
                'description' => 'Replacement Kit D-pad ABXY Keys',
                'ad_slot' => 'ads_space_2_game_controller',
                'headline' => 'Xbox Series XS Game Controller',
                'sub_headline' => 'Replacement Kit D-pad ABXY Keys',
                'call_to_action_text' => 'Learn More',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/banner.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-6',
                    'label_text' => 'Gaming'
                ])
            ],
            [
                'title' => 'PlayStation 5 DualSense Controller',
                'description' => 'Advanced haptic feedback and adaptive triggers',
                'ad_slot' => 'ads_space_2_game_controller',
                'headline' => 'PS5 DualSense Controller',
                'sub_headline' => 'Advanced haptic feedback and adaptive triggers',
                'call_to_action_text' => 'Get Yours',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/banner.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-6',
                    'label_text' => 'PlayStation'
                ])
            ]
        ];

        // Ads Space 2 - iPhone Section
        $iphoneAds = [
            [
                'title' => 'iPhone 12 Pro 128GB - Special Sale',
                'description' => 'Starting from 159,000 DJF - Special Sale',
                'ad_slot' => 'ads_space_2_iphone',
                'headline' => 'iPhone 12 Pro 128Gb',
                'sub_headline' => 'Special Sale',
                'call_to_action_text' => 'Learn More',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/banner.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-5',
                    'label_text' => 'Starting from 159,000 DJF'
                ])
            ],
            [
                'title' => 'iPhone 14 Pro Max - Latest Model',
                'description' => 'Starting from 230,000 DJF - Latest Technology',
                'ad_slot' => 'ads_space_2_iphone',
                'headline' => 'iPhone 14 Pro Max',
                'sub_headline' => 'Latest Technology',
                'call_to_action_text' => 'Pre-Order',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage9/banner.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-5',
                    'label_text' => 'Starting from 230,000 DJF'
                ])
            ]
        ];

        // Ads Space 3 - Latest Books Section
        $latestBooksAds = [
            [
                'title' => 'Latest Books - Exclusive Offers',
                'description' => 'Exclusive book deals and latest publications',
                'ad_slot' => 'ads_space_3_latest_books',
                'headline' => 'Exclusive Offers',
                'sub_headline' => 'Let\'s change things with inspiring books',
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage8/sale1.png',
                'custom_colors' => json_encode([
                    'background_class' => 'circle-1',
                    'background_image' => 'assets/imgs/page/homepage8/bg-sale1.png',
                    'background_color' => '#d1ecfd',
                    'label_text' => 'Latest Books'
                ])
            ],
            [
                'title' => 'Educational Books - Learning Hub',
                'description' => 'Premium educational books for all levels',
                'ad_slot' => 'ads_space_3_latest_books',
                'headline' => 'Learning Hub',
                'sub_headline' => 'Expand your knowledge with premium books',
                'call_to_action_text' => 'Explore Books',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage8/sale1.png',
                'custom_colors' => json_encode([
                    'background_class' => 'circle-1',
                    'background_image' => 'assets/imgs/page/homepage8/bg-sale1.png',
                    'background_color' => '#d1ecfd',
                    'label_text' => 'Educational Books'
                ])
            ]
        ];

        // Ads Space 3 - Best Collection Section
        $bestCollectionAds = [
            [
                'title' => 'Best Collection - Up to 20% Discount',
                'description' => 'Get up to 20% discount - Only this week',
                'ad_slot' => 'ads_space_3_best_collection',
                'headline' => 'Get up to 20% discount',
                'sub_headline' => 'Only this week',
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage8/sale2.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-4 circle-2',
                    'background_image' => 'assets/imgs/page/homepage8/bg-sale2.png',
                    'label_text' => 'Best collection'
                ])
            ],
            [
                'title' => 'Premium Collection - Save 35,000 DJF',
                'description' => 'Premium items collection - Save up to 35,000 DJF',
                'ad_slot' => 'ads_space_3_best_collection',
                'headline' => 'Save up to 35,000 DJF',
                'sub_headline' => 'Limited time offer',
                'call_to_action_text' => 'Get Deal',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage8/sale2.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-4 circle-2',
                    'background_image' => 'assets/imgs/page/homepage8/bg-sale2.png',
                    'label_text' => 'Premium Collection'
                ])
            ]
        ];

        // Ads Space 3 - Professional Books Section
        $professionalBooksAds = [
            [
                'title' => 'Professional Books - 50% Discount',
                'description' => 'Professional Books - Flat 50% discount',
                'ad_slot' => 'ads_space_3_professional_books',
                'headline' => 'Professional Books',
                'sub_headline' => 'Flat 50% discount',
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage8/sale3.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-10 circle-3',
                    'background_image' => 'assets/imgs/page/homepage8/bg-sale3.png',
                    'label_text' => 'Off the month'
                ])
            ],
            [
                'title' => 'Business Books - Career Growth',
                'description' => 'Business and career development books',
                'ad_slot' => 'ads_space_3_professional_books',
                'headline' => 'Career Growth',
                'sub_headline' => 'Save 25,000 DJF on bundles',
                'call_to_action_text' => 'Advance Career',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage8/sale3.png',
                'custom_colors' => json_encode([
                    'background_class' => 'bg-10 circle-3',
                    'background_image' => 'assets/imgs/page/homepage8/bg-sale3.png',
                    'label_text' => 'Business Books'
                ])
            ]
        ];

        // Ads Space 4 - Teddy Bear Section
        $teddyBearAds = [
            [
                'title' => 'Teddy Bear Sale - 10% Off',
                'description' => 'Buy Soft Spongy Teddy Bear - 10% Sale Off',
                'ad_slot' => 'ads_space_4_teddy_bear',
                'headline' => 'Buy Soft Spongy Teddy Bear',
                'sub_headline' => null,
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage7/sale1.png',
                'custom_colors' => json_encode([
                    'background_class' => 'block-sale-1',
                    'discount_text' => '10%',
                    'discount_label' => 'Sale Off',
                    'discount_color' => 'color-danger',
                    'label_color' => 'color-brand-3'
                ])
            ],
            [
                'title' => 'Premium Teddy Bears - Limited Edition',
                'description' => 'Premium collection of soft teddy bears',
                'ad_slot' => 'ads_space_4_teddy_bear',
                'headline' => 'Premium Soft Teddy Collection',
                'sub_headline' => null,
                'call_to_action_text' => 'Discover More',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage7/sale1.png',
                'custom_colors' => json_encode([
                    'background_class' => 'block-sale-1',
                    'discount_text' => '15%',
                    'discount_label' => 'Sale Off',
                    'discount_color' => 'color-danger',
                    'label_color' => 'color-brand-3'
                ])
            ]
        ];

        // Ads Space 4 - Wooden Toys Section
        $woodenToysAds = [
            [
                'title' => 'Wooden Toys - Big Discount',
                'description' => 'Wooden toy products with big discount',
                'ad_slot' => 'ads_space_4_wooden_toys',
                'headline' => 'Wooden toy products',
                'sub_headline' => null,
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage7/sale2.png',
                'custom_colors' => json_encode([
                    'background_class' => 'block-sale-1 bg-4',
                    'discount_text' => 'BIG DISCOUNT',
                    'discount_label' => '',
                    'discount_color' => 'color-danger font-bold',
                    'label_color' => 'color-brand-3'
                ])
            ],
            [
                'title' => 'Educational Wooden Toys - Save 25,000 DJF',
                'description' => 'Educational wooden toys for kids development',
                'ad_slot' => 'ads_space_4_wooden_toys',
                'headline' => 'Educational wooden toys',
                'sub_headline' => null,
                'call_to_action_text' => 'Learn More',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage7/sale2.png',
                'custom_colors' => json_encode([
                    'background_class' => 'block-sale-1 bg-4',
                    'discount_text' => 'SAVE 25,000 DJF',
                    'discount_label' => '',
                    'discount_color' => 'color-danger font-bold',
                    'label_color' => 'color-brand-3'
                ])
            ]
        ];

        // Ads Space 4 - Baby Products Section
        $babyProductsAds = [
            [
                'title' => 'Baby Products - 50% Discount',
                'description' => 'Milk powder for mother & baby - Flat 50% discount',
                'ad_slot' => 'ads_space_4_baby_products',
                'headline' => 'Milk powder for mother & baby',
                'sub_headline' => null,
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage7/sale3.png',
                'custom_colors' => json_encode([
                    'background_class' => 'block-sale-1 bg-10',
                    'discount_text' => 'Flat 50% discount',
                    'discount_label' => '',
                    'discount_color' => 'color-danger font-bold',
                    'label_color' => 'color-brand-3'
                ])
            ],
            [
                'title' => 'Baby Care Bundle - Save 45,000 DJF',
                'description' => 'Complete baby care products bundle',
                'ad_slot' => 'ads_space_4_baby_products',
                'headline' => 'Complete baby care bundle',
                'sub_headline' => null,
                'call_to_action_text' => 'Get Bundle',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage7/sale3.png',
                'custom_colors' => json_encode([
                    'background_class' => 'block-sale-1 bg-10',
                    'discount_text' => 'Save 45,000 DJF',
                    'discount_label' => '',
                    'discount_color' => 'color-danger font-bold',
                    'label_color' => 'color-brand-3'
                ])
            ]
        ];

        // Ads Space 5 - Kitchen Appliances Section
        $kitchenAppliancesAds = [
            [
                'title' => 'Kitchen Appliances - Premium Collection',
                'description' => 'Keep cabinets, countertops & more in order with the right solutions',
                'ad_slot' => 'ads_space_5_kitchen_appliances',
                'headline' => 'kitchen appliances',
                'sub_headline' => 'Keep cabinets, countertops & more in order with the right solutions. Get it now!',
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage7/banner-ads.jpg',
                'custom_colors' => json_encode([
                    'background_class' => 'banner-ads-3',
                    'background_color' => '#142b42',
                    'title_color' => 'color-brand-2',
                    'text_color' => 'color-white',
                    'title_size' => 'font-46',
                    'background_image_main' => 'assets/imgs/page/homepage3/bg-ads.png',
                    'background_image_before' => 'assets/imgs/page/homepage3/bg-left-ads.png',
                    'background_image_after' => 'assets/imgs/page/homepage3/bg-right-ads.png',
                ]),
            ],
            [
                'title' => 'Smart Kitchen Solutions - Save 65,000 DJF',
                'description' => 'Modern kitchen appliances with smart technology',
                'ad_slot' => 'ads_space_5_kitchen_appliances',
                'headline' => 'smart kitchen solutions',
                'sub_headline' => 'Transform your kitchen with modern appliances and smart technology. Save up to 65,000 DJF!',
                'call_to_action_text' => 'Discover More',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage7/banner-ads.jpg',
                'custom_colors' => json_encode([
                    'background_class' => 'banner-ads-3',
                    'background_color' => '#f2f2f2',
                    'title_color' => 'color-brand-1',
                    'text_color' => 'color-gray-900',
                    'title_size' => 'font-46',
                    'background_image_main' => 'assets/imgs/page/homepage3/bg-ads.png',
                    'background_image_before' => 'assets/imgs/page/homepage3/bg-left-ads.png',
                    'background_image_after' => 'assets/imgs/page/homepage3/bg-right-ads.png',
                ]),
            ]
        ];

        // Combine all ad arrays into one
        $adsData = array_merge(
            $mainBannerAds,
            $weeklyDealAds,
            $techProductsAds,
            $powerBankAds,
            $gameControllerAds,
            $iphoneAds,
            $latestBooksAds,
            $bestCollectionAds,
            $professionalBooksAds,
            $teddyBearAds,
            $woodenToysAds,
            $babyProductsAds,
            $kitchenAppliancesAds,
            // Add other ad arrays here as they are created
        );

        // Ad space 6
        $adsData = array_merge($adsData, [
            [
                'title' => 'Limited Chairs Offer',
                'ad_slot' => 'ads_space_6_chairs',
                'headline' => '70% off on limited chairs',
                'sub_headline' => 'Free shipping available for purchases more than 15,000 DJF.',
                'call_to_action_text' => 'View Products',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage6/chair.png',
                'custom_colors' => json_encode([
                    'background_class' => 'banner-ads-3',
                    'background_color' => '#eaf4f0',
                    'background_repeat' => 'no-repeat',
                    'background_position' => 'right center',
                    'background_size' => 'contain',
                    'title_color' => 'color-gray-900',
                    'text_color' => 'color-gray-900',
                    'button_class' => 'btn-brand-3',
                ]),
            ],
        ]);

        // Ads Space 7
        $adsData = array_merge($adsData, [
            // Left Ad
            [
                'title' => 'Latest Books - Exclusive Offers',
                'ad_slot' => 'ads_space_7_left',
                'headline' => 'Exclusive Offers',
                'sub_headline' => 'Nullam diam tellus, convallis vel rhoncus vel, condimentum',
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage8/book-ads1.png',
                'custom_colors' => json_encode([
                    'background_class' => 'block-sale-3',
                    'label_text' => 'Latest Books'
                ]),
            ],
            // Right Ad
            [
                'title' => 'History Books - For Collection',
                'ad_slot' => 'ads_space_7_right',
                'headline' => 'History Books',
                'sub_headline' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean maximus laoreet',
                'call_to_action_text' => 'Shop Now',
                'call_to_action_url' => route('buyer.home'),
                'ad_image' => 'assets/imgs/page/homepage8/book-ads2.png',
                'custom_colors' => json_encode([
                    'background_class' => 'block-sale-3 bg-29',
                    'label_text' => 'For Collection'
                ]),
            ],
        ]);

        // Common attributes for all ads with Djiboutian Franc (DJF) pricing
        $commonAttributes = [
            'seller_id' => 1, // Assuming seller with ID 1 exists
            'pricing_type' => 'daily',
            'daily_rate' => 10.00, // 8,500 DJF per day
            'total_budget' => 255000.00, // 255,000 DJF total budget
            'start_date' => Carbon::now()->subDays(30),
            'end_date' => Carbon::now()->addDays(60),
            'duration_days' => 90,
            'max_views' => 150000,
            'max_clicks' => 7500,
            'current_views' => rand(0, 100),
            'current_clicks' => rand(0, 100),
            'current_cost' => rand(0, 100), // Cost in DJF
            'status' => 'active',
            'approved_at' => Carbon::now()->subDays(25),
            'approved_by' => 1, // Assuming admin with ID 1 exists
            'auto_paused' => false,
            'created_at' => Carbon::now()->subDays(30),
            'updated_at' => Carbon::now(),
        ];

        foreach ($adsData as $adData) {
            SellerAd::updateOrCreate(
                ['ad_slot' => $adData['ad_slot'], 'title' => $adData['title']],
                array_merge($adData, $commonAttributes)
            );
        }

        // After seeding, ensure all ads are active and not auto-paused
        SellerAd::query()->update([
            'status'      => SellerAd::STATUS_ACTIVE,
            'auto_paused' => false,
            'pause_reason' => null,
        ]);

        // $this->command->info('SellerAds seeded successfully with DJF pricing!');
    }
}