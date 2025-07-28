<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BrandType;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;

class TopBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, create brand types
        $brandTypes = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Home & Kitchen', 'slug' => 'home-kitchen'],
            ['name' => 'Beauty & Personal Care', 'slug' => 'beauty-personal-care'],
            ['name' => 'Sports & Outdoors', 'slug' => 'sports-outdoors'],
            ['name' => 'Automotive', 'slug' => 'automotive'],
            ['name' => 'Toys & Games', 'slug' => 'toys-games'],
            ['name' => 'Baby & Kids', 'slug' => 'baby-kids'],
        ];

        foreach ($brandTypes as $brandType) {
            BrandType::firstOrCreate(
                ['slug' => $brandType['slug']],
                $brandType
            );
        }

        // Create brands with their logos
        $brands = [
            // Electronics brands
            ['name' => 'Samsung', 'slug' => 'samsung', 'type' => 'electronics', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Samsung-Logo.png', 'website' => 'https://samsung.com'],
            ['name' => 'Apple', 'slug' => 'apple', 'type' => 'electronics', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Apple-Logo.png', 'website' => 'https://apple.com'],
            ['name' => 'Sony', 'slug' => 'sony', 'type' => 'electronics', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Sony-Logo.png', 'website' => 'https://sony.com'],
            ['name' => 'LG', 'slug' => 'lg', 'type' => 'electronics', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/LG-Logo.png', 'website' => 'https://lg.com'],
            ['name' => 'HP', 'slug' => 'hp', 'type' => 'electronics', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/HP-Logo.png', 'website' => 'https://hp.com'],
            ['name' => 'Dell', 'slug' => 'dell', 'type' => 'electronics', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Dell-Logo.png', 'website' => 'https://dell.com'],
            ['name' => 'Microsoft', 'slug' => 'microsoft', 'type' => 'electronics', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Microsoft-Logo.png', 'website' => 'https://microsoft.com'],
            ['name' => 'Canon', 'slug' => 'canon', 'type' => 'electronics', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Canon-Logo.png', 'website' => 'https://canon.com'],

            // Fashion brands
            ['name' => 'Nike', 'slug' => 'nike', 'type' => 'fashion', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Nike-Logo.png', 'website' => 'https://nike.com'],
            ['name' => 'Adidas', 'slug' => 'adidas', 'type' => 'fashion', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Adidas-Logo.png', 'website' => 'https://adidas.com'],
            ['name' => 'Puma', 'slug' => 'puma', 'type' => 'fashion', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Puma-Logo.png', 'website' => 'https://puma.com'],
            ['name' => 'Under Armour', 'slug' => 'under-armour', 'type' => 'fashion', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Under-Armour-Logo.png', 'website' => 'https://underarmour.com'],
            ['name' => 'Reebok', 'slug' => 'reebok', 'type' => 'fashion', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Reebok-Logo.png', 'website' => 'https://reebok.com'],
            ['name' => 'Zara', 'slug' => 'zara', 'type' => 'fashion', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Zara-Logo.png', 'website' => 'https://zara.com'],
            ['name' => 'H&M', 'slug' => 'hm', 'type' => 'fashion', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/HM-Logo.png', 'website' => 'https://hm.com'],
            ['name' => 'Gucci', 'slug' => 'gucci', 'type' => 'fashion', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Gucci-Logo.png', 'website' => 'https://gucci.com'],

            // Home & Kitchen brands
            ['name' => 'KitchenAid', 'slug' => 'kitchenaid', 'type' => 'home-kitchen', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/KitchenAid-Logo.png', 'website' => 'https://kitchenaid.com'],
            ['name' => 'Dyson', 'slug' => 'dyson', 'type' => 'home-kitchen', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Dyson-Logo.png', 'website' => 'https://dyson.com'],
            ['name' => 'IKEA', 'slug' => 'ikea', 'type' => 'home-kitchen', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/IKEA-Logo.png', 'website' => 'https://ikea.com'],
            ['name' => 'Bosch', 'slug' => 'bosch', 'type' => 'home-kitchen', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Bosch-Logo.png', 'website' => 'https://bosch.com'],
            ['name' => 'Philips', 'slug' => 'philips', 'type' => 'home-kitchen', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Philips-Logo.png', 'website' => 'https://philips.com'],
            ['name' => 'Whirlpool', 'slug' => 'whirlpool', 'type' => 'home-kitchen', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Whirlpool-Logo.png', 'website' => 'https://whirlpool.com'],
            ['name' => 'Black+Decker', 'slug' => 'black-decker', 'type' => 'home-kitchen', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Black-Decker-Logo.png', 'website' => 'https://blackanddecker.com'],
            ['name' => 'Cuisinart', 'slug' => 'cuisinart', 'type' => 'home-kitchen', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Cuisinart-Logo.png', 'website' => 'https://cuisinart.com'],

            // Beauty & Personal Care brands
            ['name' => 'L\'Oreal', 'slug' => 'loreal', 'type' => 'beauty-personal-care', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/LOreal-Logo.png', 'website' => 'https://loreal.com'],
            ['name' => 'Maybelline', 'slug' => 'maybelline', 'type' => 'beauty-personal-care', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Maybelline-Logo.png', 'website' => 'https://maybelline.com'],
            ['name' => 'MAC', 'slug' => 'mac', 'type' => 'beauty-personal-care', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/MAC-Logo.png', 'website' => 'https://maccosmetics.com'],
            ['name' => 'Clinique', 'slug' => 'clinique', 'type' => 'beauty-personal-care', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Clinique-Logo.png', 'website' => 'https://clinique.com'],
            ['name' => 'Estée Lauder', 'slug' => 'estee-lauder', 'type' => 'beauty-personal-care', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Estee-Lauder-Logo.png', 'website' => 'https://esteelauder.com'],
            ['name' => 'NYX Professional Makeup', 'slug' => 'nyx', 'type' => 'beauty-personal-care', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/NYX-Logo.png', 'website' => 'https://nyxcosmetics.com'],
            ['name' => 'Urban Decay', 'slug' => 'urban-decay', 'type' => 'beauty-personal-care', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Urban-Decay-Logo.png', 'website' => 'https://urbandecay.com'],
            ['name' => 'Sephora', 'slug' => 'sephora', 'type' => 'beauty-personal-care', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Sephora-Logo.png', 'website' => 'https://sephora.com'],

            // Sports & Outdoors brands
            ['name' => 'The North Face', 'slug' => 'the-north-face', 'type' => 'sports-outdoors', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/The-North-Face-Logo.png', 'website' => 'https://thenorthface.com'],
            ['name' => 'Patagonia', 'slug' => 'patagonia', 'type' => 'sports-outdoors', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Patagonia-Logo.png', 'website' => 'https://patagonia.com'],
            ['name' => 'Columbia', 'slug' => 'columbia', 'type' => 'sports-outdoors', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Columbia-Logo.png', 'website' => 'https://columbia.com'],
            ['name' => 'REI', 'slug' => 'rei', 'type' => 'sports-outdoors', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/REI-Logo.png', 'website' => 'https://rei.com'],
            ['name' => 'Yeti', 'slug' => 'yeti', 'type' => 'sports-outdoors', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Yeti-Logo.png', 'website' => 'https://yeti.com'],
            ['name' => 'Wilson', 'slug' => 'wilson', 'type' => 'sports-outdoors', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Wilson-Logo.png', 'website' => 'https://wilson.com'],
            ['name' => 'Spalding', 'slug' => 'spalding', 'type' => 'sports-outdoors', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Spalding-Logo.png', 'website' => 'https://spalding.com'],
            ['name' => 'Callaway', 'slug' => 'callaway', 'type' => 'sports-outdoors', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Callaway-Logo.png', 'website' => 'https://callaway.com'],

            // Automotive brands
            ['name' => 'Bosch Auto', 'slug' => 'bosch-auto', 'type' => 'automotive', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Bosch-Logo.png', 'website' => 'https://bosch.com'],
            ['name' => 'Michelin', 'slug' => 'michelin', 'type' => 'automotive', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Michelin-Logo.png', 'website' => 'https://michelin.com'],
            ['name' => 'Goodyear', 'slug' => 'goodyear', 'type' => 'automotive', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Goodyear-Logo.png', 'website' => 'https://goodyear.com'],
            ['name' => 'Castrol', 'slug' => 'castrol', 'type' => 'automotive', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Castrol-Logo.png', 'website' => 'https://castrol.com'],
            ['name' => 'Mobil 1', 'slug' => 'mobil-1', 'type' => 'automotive', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Mobil-1-Logo.png', 'website' => 'https://mobil.com'],
            ['name' => '3M Automotive', 'slug' => '3m-automotive', 'type' => 'automotive', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/3M-Logo.png', 'website' => 'https://3m.com'],
            ['name' => 'Chemical Guys', 'slug' => 'chemical-guys', 'type' => 'automotive', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Chemical-Guys-Logo.png', 'website' => 'https://chemicalguys.com'],
            ['name' => 'Armor All', 'slug' => 'armor-all', 'type' => 'automotive', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Armor-All-Logo.png', 'website' => 'https://armorall.com'],

            // Toys & Games brands
            ['name' => 'LEGO', 'slug' => 'lego', 'type' => 'toys-games', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/LEGO-Logo.png', 'website' => 'https://lego.com'],
            ['name' => 'Mattel', 'slug' => 'mattel', 'type' => 'toys-games', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Mattel-Logo.png', 'website' => 'https://mattel.com'],
            ['name' => 'Hasbro', 'slug' => 'hasbro', 'type' => 'toys-games', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Hasbro-Logo.png', 'website' => 'https://hasbro.com'],
            ['name' => 'Fisher-Price', 'slug' => 'fisher-price', 'type' => 'toys-games', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Fisher-Price-Logo.png', 'website' => 'https://fisher-price.com'],
            ['name' => 'Playmobil', 'slug' => 'playmobil', 'type' => 'toys-games', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Playmobil-Logo.png', 'website' => 'https://playmobil.com'],
            ['name' => 'Barbie', 'slug' => 'barbie', 'type' => 'toys-games', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Barbie-Logo.png', 'website' => 'https://barbie.com'],
            ['name' => 'Hot Wheels', 'slug' => 'hot-wheels', 'type' => 'toys-games', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Hot-Wheels-Logo.png', 'website' => 'https://hotwheels.com'],
            ['name' => 'Nerf', 'slug' => 'nerf', 'type' => 'toys-games', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Nerf-Logo.png', 'website' => 'https://nerf.com'],

            // Baby & Kids brands
            ['name' => 'Pampers', 'slug' => 'pampers', 'type' => 'baby-kids', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Pampers-Logo.png', 'website' => 'https://pampers.com'],
            ['name' => 'Huggies', 'slug' => 'huggies', 'type' => 'baby-kids', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Huggies-Logo.png', 'website' => 'https://huggies.com'],
            ['name' => 'Gerber', 'slug' => 'gerber', 'type' => 'baby-kids', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Gerber-Logo.png', 'website' => 'https://gerber.com'],
            ['name' => 'Johnson\'s', 'slug' => 'johnsons', 'type' => 'baby-kids', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Johnsons-Logo.png', 'website' => 'https://johnsonsbaby.com'],
            ['name' => 'Enfamil', 'slug' => 'enfamil', 'type' => 'baby-kids', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Enfamil-Logo.png', 'website' => 'https://enfamil.com'],
            ['name' => 'Similac', 'slug' => 'similac', 'type' => 'baby-kids', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Similac-Logo.png', 'website' => 'https://similac.com'],
            ['name' => 'Carter\'s', 'slug' => 'carters', 'type' => 'baby-kids', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Carters-Logo.png', 'website' => 'https://carters.com'],
            ['name' => 'Chicco', 'slug' => 'chicco', 'type' => 'baby-kids', 'logo' => 'https://logos-world.net/wp-content/uploads/2020/04/Chicco-Logo.png', 'website' => 'https://chicco.com'],
        ];

        // Create brands
        $createdBrands = [];
        foreach ($brands as $brandData) {
            $brandType = BrandType::where('slug', $brandData['type'])->first();

            $brand = Brand::firstOrCreate(
                ['slug' => $brandData['slug']],
                [
                    'name' => $brandData['name'],
                    'logo' => $brandData['logo'],
                    'website' => $brandData['website'],
                    'brand_type_id' => $brandType->id,
                    'description' => 'Leading ' . $brandData['name'] . ' brand in ' . str_replace('-', ' ', $brandData['type']) . ' category.',
                ]
            );

            $createdBrands[$brandData['type']][] = $brand;
        }

        // Get all super categories (categories with null parent_id)
        $superCategories = Category::whereNull('parent_id')->get();

        // Category to brand type mapping
        $categoryToBrandTypeMapping = [
            'electronics' => 'electronics',
            'computers' => 'electronics',
            'phones' => 'electronics',
            'home-kitchen' => 'home-kitchen',
            'home' => 'home-kitchen',
            'kitchen' => 'home-kitchen',
            'fashion' => 'fashion',
            'clothing' => 'fashion',
            'shoes' => 'fashion',
            'beauty' => 'beauty-personal-care',
            'health' => 'beauty-personal-care',
            'sports' => 'sports-outdoors',
            'fitness' => 'sports-outdoors',
            'outdoors' => 'sports-outdoors',
            'automotive' => 'automotive',
            'auto' => 'automotive',
            'car' => 'automotive',
            'toys' => 'toys-games',
            'games' => 'toys-games',
            'baby' => 'baby-kids',
            'kids' => 'baby-kids',
            'children' => 'baby-kids',
        ];

        // Assign top brands to super categories
        foreach ($superCategories as $category) {
            $categorySlug = $category->slug;

            // Find matching brand type based on category slug
            $brandType = null;
            foreach ($categoryToBrandTypeMapping as $key => $value) {
                if (str_contains($categorySlug, $key)) {
                    $brandType = $value;
                    break;
                }
            }

            // If no exact match, use a default based on category name
            if (!$brandType) {
                $categoryName = strtolower($category->name);
                foreach ($categoryToBrandTypeMapping as $key => $value) {
                    if (str_contains($categoryName, $key)) {
                        $brandType = $value;
                        break;
                    }
                }
            }

            // Default to electronics if no match found
            if (!$brandType) {
                $brandType = 'electronics';
            }

            // Get brands for this type
            $brandsForCategory = $createdBrands[$brandType] ?? $createdBrands['electronics'];

            // Assign up to 8 brands as top brands for this category
            $brandsToAssign = array_slice($brandsForCategory, 0, 8);

            foreach ($brandsToAssign as $index => $brand) {
                $category->topBrands()->syncWithoutDetaching([
                    $brand->id => [
                        'is_top_brand' => true,
                        'priority' => $index + 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                ]);
            }
        }

        $this->command->info('Top brands seeder completed successfully!');
        $this->command->info('Created ' . count($brands) . ' brands across ' . count($brandTypes) . ' brand types');
        $this->command->info('Assigned top brands to ' . $superCategories->count() . ' super categories');
    }
}