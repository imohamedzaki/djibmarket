<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB; // Use DB facade for truncate

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks to truncate, then re-enable
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        Category::truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        // --- Level 1 Categories ---
        $level1Categories = [
            [
                "name" => "Electronics",
                "name_ar" => "إلكترونيات",
                "name_fr" => "Électronique",
                "description" => "Gadgets, devices, and accessories.",
            ],
            [
                "name" => "Fashion",
                "name_ar" => "موضة",
                "name_fr" => "Mode",
                "description" => "Clothing, shoes, and accessories.",
            ],
            [
                "name" => "Home & Garden",
                "name_ar" => "المنزل والحديقة",
                "name_fr" => "Maison & Jardin",
                "description" =>
                "Furniture, decor, tools, and gardening supplies.",
            ],
            [
                "name" => "Sports & Outdoors",
                "name_ar" => "رياضة وأنشطة خارجية",
                "name_fr" => "Sports & Plein Air",
                "description" =>
                "Sporting goods, camping, and fitness equipment.",
            ],
            [
                "name" => "Toys & Games",
                "name_ar" => "ألعاب وهوايات",
                "name_fr" => "Jouets & Jeux",
                "description" => "Toys for all ages, board games, and puzzles.",
            ],
            [
                "name" => "Books & Media",
                "name_ar" => "كتب وإعلام",
                "name_fr" => "Livres & Médias",
                "description" => "Books, movies, music, and video games.",
            ],
            [
                "name" => "Health & Beauty",
                "name_ar" => "صحة وجمال",
                "name_fr" => "Santé & Beauté",
                "description" =>
                "Personal care, cosmetics, and wellness products.",
            ],
            [
                "name" => "Automotive",
                "name_ar" => "سيارات",
                "name_fr" => "Automobile",
                "description" => "Vehicle parts, accessories, and tools.",
            ],
            [
                "name" => "Groceries",
                "name_ar" => "بقالة",
                "name_fr" => "Épicerie",
                "description" => "Food items and household essentials.",
            ],
            [
                "name" => "Services",
                "name_ar" => "خدمات",
                "name_fr" => "Services",
                "description" =>
                "Local services, repairs, and professional services.",
            ],
            [
                "name" => "Today's Deals",
                "name_ar" => "عروض اليوم",
                "name_fr" => "Offres du jour",
                "description" => "Special promotions available today.",
            ],
        ];

        $createdLevel1 = [];
        foreach ($level1Categories as $catData) {
            $createdLevel1[$catData["name"]] = Category::create($catData);
        }

        // --- Level 2 Categories ---
        $level2Categories = [
            // Electronics Children
            [
                "parent" => "Electronics",
                "name" => "Mobile Phones & Accessories",
                "name_ar" => "هواتف محمولة واكسسواراتها",
                "name_fr" => "Téléphones Mobiles & Accessoires",
                "description" =>
                "Smartphones, feature phones, cases, chargers.",
            ],
            [
                "parent" => "Electronics",
                "name" => "Computers & Laptops",
                "name_ar" => "كمبيوترات ولابتوبات",
                "name_fr" => "Ordinateurs & Portables",
                "description" => "Desktops, laptops, tablets, monitors.",
            ],
            [
                "parent" => "Electronics",
                "name" => "Cameras & Photography",
                "name_ar" => "كاميرات وتصوير",
                "name_fr" => "Appareils Photo & Photographie",
                "description" => "Digital cameras, lenses, tripods.",
            ],
            [
                "parent" => "Electronics",
                "name" => "Audio & Headphones",
                "name_ar" => "صوتيات وسماعات",
                "name_fr" => "Audio & Casques",
                "description" => "Speakers, headphones, home audio systems.",
            ],
            [
                "parent" => "Electronics",
                "name" => "Wearable Technology",
                "name_ar" => "تكنولوجيا قابلة للارتداء",
                "name_fr" => "Technologie Portable",
                "description" => "Smartwatches, fitness trackers.",
            ],

            // Fashion Children
            [
                "parent" => "Fashion",
                "name" => 'Women\'s Fashion',
                "name_ar" => "أزياء نسائية",
                "name_fr" => "Mode Femme",
                "description" => "Clothing, shoes, bags for women.",
            ],
            [
                "parent" => "Fashion",
                "name" => 'Men\'s Fashion',
                "name_ar" => "أزياء رجالية",
                "name_fr" => "Mode Homme",
                "description" => "Clothing, shoes, accessories for men.",
            ],
            [
                "parent" => "Fashion",
                "name" => 'Kid\'s Fashion',
                "name_ar" => "أزياء أطفال",
                "name_fr" => "Mode Enfant",
                "description" => "Clothing and shoes for children.",
            ],
            [
                "parent" => "Fashion",
                "name" => "Watches & Jewelry",
                "name_ar" => "ساعات ومجوهرات",
                "name_fr" => "Montres & Bijoux",
                "description" =>
                "Fashion and luxury watches, rings, necklaces.",
            ],

            // Home & Garden Children
            [
                "parent" => "Home & Garden",
                "name" => "Furniture",
                "name_ar" => "أثاث",
                "name_fr" => "Meubles",
                "description" => "Living room, bedroom, office furniture.",
            ],
            [
                "parent" => "Home & Garden",
                "name" => "Home Decor",
                "name_ar" => "ديكور منزلي",
                "name_fr" => "Décoration Intérieure",
                "description" => "Rugs, lighting, wall art.",
            ],
            [
                "parent" => "Home & Garden",
                "name" => "Kitchen & Dining",
                "name_ar" => "مطبخ وطعام",
                "name_fr" => "Cuisine & Salle à Manger",
                "description" => "Cookware, tableware, small appliances.",
            ],
            [
                "parent" => "Home & Garden",
                "name" => "Garden & Outdoor",
                "name_ar" => "حديقة وأماكن خارجية",
                "name_fr" => "Jardin & Extérieur",
                "description" => "Gardening tools, outdoor furniture, grills.",
            ],

            // Sports & Outdoors Children
            [
                "parent" => "Sports & Outdoors",
                "name" => "Team Sports",
                "name_ar" => "رياضات جماعية",
                "name_fr" => "Sports Collectifs",
                "description" => "Football, basketball, volleyball gear.",
            ],
            [
                "parent" => "Sports & Outdoors",
                "name" => "Fitness & Exercise",
                "name_ar" => "لياقة بدنية وتمارين",
                "name_fr" => "Fitness & Exercice",
                "description" => "Weights, yoga mats, treadmills.",
            ],
            [
                "parent" => "Sports & Outdoors",
                "name" => "Camping & Hiking",
                "name_ar" => "تخييم وتنزه",
                "name_fr" => "Camping & Randonnée",
                "description" => "Tents, sleeping bags, backpacks.",
            ],

            // Books & Media Children
            [
                "parent" => "Books & Media",
                "name" => "Fiction Books",
                "name_ar" => "كتب خيالية",
                "name_fr" => "Livres de Fiction",
                "description" => "Novels, thrillers, fantasy.",
            ],
            [
                "parent" => "Books & Media",
                "name" => "Non-Fiction Books",
                "name_ar" => "كتب غير خيالية",
                "name_fr" => "Livres Non-Fiction",
                "description" => "Biographies, history, self-help.",
            ],
            [
                "parent" => "Books & Media",
                "name" => "Movies & TV Shows",
                "name_ar" => "أفلام وبرامج تلفزيونية",
                "name_fr" => "Films & Séries TV",
                "description" => "DVDs, Blu-rays, streaming.",
            ],
            [
                "parent" => "Books & Media",
                "name" => "Music",
                "name_ar" => "موسيقى",
                "name_fr" => "Musique",
                "description" => "CDs, vinyl, digital music.",
            ],

            // Automotive Children
            [
                "parent" => "Automotive",
                "name" => "Car Parts",
                "name_ar" => "قطع غيار سيارات",
                "name_fr" => "Pièces Automobiles",
                "description" => "Engine parts, brakes, filters.",
            ],
            [
                "parent" => "Automotive",
                "name" => "Car Accessories",
                "name_ar" => "اكسسوارات سيارات",
                "name_fr" => "Accessoires Automobiles",
                "description" => "Seat covers, floor mats, electronics.",
            ],
            [
                "parent" => "Automotive",
                "name" => "Tools & Equipment",
                "name_ar" => "أدوات ومعدات",
                "name_fr" => "Outils & Équipement",
                "description" => "Hand tools, power tools, diagnostic tools.",
            ],


        ];

        $createdLevel2 = [];
        foreach ($level2Categories as $catData) {
            $parentName = $catData["parent"];
            if (isset($createdLevel1[$parentName])) {
                $catData["parent_id"] = $createdLevel1[$parentName]->id;
                unset($catData["parent"]); // Remove temporary parent key
                $createdLevel2[$catData["name"]] = Category::create($catData);
            } else {
                // Handle error: parent not found (optional logging)
                $this->command->error(
                    "Parent category '{$parentName}' not found for '{$catData["name"]}'. Skipping."
                );
            }
        }

        // --- Level 3 Categories ---
        $level3Categories = [
            // Mobile Phones & Accessories Children
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "Smartphones",
                "name_ar" => "هواتف ذكية",
                "name_fr" => "Smartphones",
                "description" => "Latest smartphones.",
            ],
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "Phone Cases",
                "name_ar" => "أغطية هواتف",
                "name_fr" => "Coques de Téléphone",
                "description" => "Protective and stylish cases.",
            ],
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "Chargers & Cables",
                "name_ar" => "شواحن وكابلات",
                "name_fr" => "Chargeurs & Câbles",
                "description" => "Wall chargers, car chargers, USB cables.",
            ],

            // Women's Fashion Children
            [
                "parent" => 'Women\'s Fashion',
                "name" => "Dresses",
                "name_ar" => "فساتين",
                "name_fr" => "Robes",
                "description" => "Casual, formal, and party dresses.",
            ],
            [
                "parent" => 'Women\'s Fashion',
                "name" => "Tops & Blouses",
                "name_ar" => "بلوزات وتوبات",
                "name_fr" => "Hauts & Chemisiers",
                "description" => "Shirts, t-shirts, blouses.",
            ],
            [
                "parent" => 'Women\'s Fashion',
                "name" => "Shoes",
                "name_ar" => "أحذية نسائية",
                "name_fr" => "Chaussures Femme",
                "description" => "Heels, flats, boots, sandals.",
            ],

            // Men's Fashion Children
            [
                "parent" => 'Men\'s Fashion',
                "name" => "Shirts",
                "name_ar" => "قمصان رجالية",
                "name_fr" => "Chemises Homme",
                "description" => "Formal, casual, polo shirts.",
            ],
            [
                "parent" => 'Men\'s Fashion',
                "name" => "Trousers & Jeans",
                "name_ar" => "بناطيل وجينز",
                "name_fr" => "Pantalons & Jeans",
                "description" => "Chinos, jeans, formal trousers.",
            ],
            [
                "parent" => 'Men\'s Fashion',
                "name" => "Shoes",
                "name_ar" => "أحذية رجالية",
                "name_fr" => "Chaussures Homme",
                "description" => "Formal shoes, sneakers, boots.",
            ],

            // Furniture Children
            [
                "parent" => "Furniture",
                "name" => "Living Room Furniture",
                "name_ar" => "أثاث غرفة المعيشة",
                "name_fr" => "Meubles de Salon",
                "description" => "Sofas, coffee tables, TV stands.",
            ],
            [
                "parent" => "Furniture",
                "name" => "Bedroom Furniture",
                "name_ar" => "أثاث غرفة النوم",
                "name_fr" => "Meubles de Chambre",
                "description" => "Beds, wardrobes, nightstands.",
            ],

            // Additional Electronics Accessories
            [
                "parent" => "Computers & Laptops",
                "name" => "Computers Accessories",
                "name_ar" => "اكسسوارات الكمبيوتر",
                "name_fr" => "Accessoires Informatique",
                "description" => "Keyboards, mice, USB devices, and more.",
            ],
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "Cell Phones",
                "name_ar" => "هواتف خلوية",
                "name_fr" => "Téléphones Mobiles",
                "description" => "Basic and feature mobile phones.",
            ],
            [
                "parent" => "Wearable Technology",
                "name" => "Smart Watches",
                "name_ar" => "ساعات ذكية",
                "name_fr" => "Montres Intelligentes",
                "description" => "Smart watches for all brands.",
            ],
            [
                "parent" => "Audio & Headphones",
                "name" => "Wired Headphones",
                "name_ar" => "سماعات سلكية",
                "name_fr" => "Casques Filaire",
                "description" => "Traditional wired headphones.",
            ],
            [
                "parent" => "Computers & Laptops",
                "name" => "Mouse & Keyboard",
                "name_ar" => "فأرة ولوحة مفاتيح",
                "name_fr" => "Souris & Clavier",
                "description" => "Computer mice and keyboards.",
            ],
            [
                "parent" => "Audio & Headphones",
                "name" => "Bluetooth Devices",
                "name_ar" => "أجهزة بلوتوث",
                "name_fr" => "Appareils Bluetooth",
                "description" => "Wireless speakers, earbuds, and transmitters.",
            ],
            [
                "parent" => "Computers & Laptops",
                "name" => "Gaming Gadgets",
                "name_ar" => "أجهزة الألعاب",
                "name_fr" => "Gadgets de Jeu",
                "description" => "Gaming consoles, controllers, and gear.",
            ],
            [
                "parent" => "Computers & Laptops",
                "name" => "Cloud Software",
                "name_ar" => "برمجيات سحابية",
                "name_fr" => "Logiciels Cloud",
                "description" => "Cloud-based applications and services.",
            ],
            [
                "parent" => "Computers & Laptops",
                "name" => "Computer Cases",
                "name_ar" => "صناديق الحاسوب",
                "name_fr" => "Boîtiers PC",
                "description" => "Computer towers and cases.",
            ],
            [
                "parent" => "Computers & Laptops",
                "name" => "HDD",
                "name_ar" => "أقراص صلبة",
                "name_fr" => "Disques Durs",
                "description" => "Hard disk drives and storage.",
            ],
            [
                "parent" => "Computers & Laptops",
                "name" => "RAM",
                "name_ar" => "رام",
                "name_fr" => "Mémoire Vive",
                "description" => "Memory modules and RAM.",
            ],
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "Postpaid Phones",
                "name_ar" => "هواتف الدفع الآجل",
                "name_fr" => "Téléphones Postpayés",
                "description" => "Phones with postpaid plans.",
            ],
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "Unlocked Phones",
                "name_ar" => "هواتف غير مقيدة",
                "name_fr" => "Téléphones Débloqués",
                "description" => "Phones that work on all networks.",
            ],
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "Prepaid Phones",
                "name_ar" => "هواتف الدفع المسبق",
                "name_fr" => "Téléphones Prépayés",
                "description" => "Phones with prepaid service.",
            ],
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "Prepaid Plans",
                "name_ar" => "باقات الدفع المسبق",
                "name_fr" => "Forfaits Prépayés",
                "description" => "Prepaid mobile plans.",
            ],
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "Refurbished Phones",
                "name_ar" => "هواتف مجددة",
                "name_fr" => "Téléphones Reconditionnés",
                "description" => "Certified refurbished phones.",
            ],
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "Straight Talk",
                "name_ar" => "خدمة سترايت توك",
                "name_fr" => "Straight Talk",
                "description" => "Straight Talk phone services.",
            ],
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "iPhone",
                "name_ar" => "آيفون",
                "name_fr" => "iPhone",
                "description" => "Apple smartphones.",
            ],
            [
                "parent" => "Mobile Phones & Accessories",
                "name" => "Samsung Galaxy",
                "name_ar" => "سامسونج جالاكسي",
                "name_fr" => "Samsung Galaxy",
                "description" => "Samsung Galaxy series.",
            ],
            [
                "parent" => "Audio & Headphones",
                "name" => "Airpod",
                "name_ar" => "سماعة Airpod",
                "name_fr" => "Airpod",
                "description" => "Apple AirPods and accessories.",
            ],
            [
                "parent" => "Electronics",
                "name" => "Electric Accessories",
                "name_ar" => "مستلزمات كهربائية",
                "name_fr" => "Accessoires Électriques",
                "description" => "Plugs, sockets, adapters, etc.",
            ],
            [
                "parent" => "Computers & Laptops",
                "name" => "Mainboard & CPU",
                "name_ar" => "لوحة أم ومعالج",
                "name_fr" => "Carte Mère & Processeur",
                "description" => "Motherboards and CPUs.",
            ],
            [
                "parent" => "Computers & Laptops",
                "name" => "Desktop",
                "name_ar" => "حاسوب مكتبي",
                "name_fr" => "Ordinateur de Bureau",
                "description" => "Desktop computer systems.",
            ],
            [
                "parent" => "Audio & Headphones",
                "name" => "Speaker",
                "name_ar" => "مكبر صوت",
                "name_fr" => "Haut-parleur",
                "description" => "Speakers for home and mobile use.",
            ],
            [
                "parent" => "Computers & Laptops",
                "name" => "Computer Decor",
                "name_ar" => "ديكور الحاسوب",
                "name_fr" => "Décor Informatique",
                "description" => "Decorative accessories for computers.",
            ],
            [
                "parent" => "Today's Deals",
                "name" => "12 Days Of Deals",
                "name_ar" => "12 يوم من العروض",
                "name_fr" => "12 Jours de Promos",
                "description" => "Limited-time deals over a 12-day period.",
            ],
            [
                "parent" => "Services",
                "name" => "Customer Service",
                "name_ar" => "خدمة العملاء",
                "name_fr" => "Service Clientèle",
                "description" => "Support and service options for customers.",
            ],
            [
                "parent" => "Services",
                "name" => "Gift Cards",
                "name_ar" => "بطاقات الهدايا",
                "name_fr" => "Cartes Cadeaux",
                "description" => "Purchase and manage gift cards.",
            ],
            [
                "parent" => "Furniture",
                "name" => "Dressers",
                "name_ar" => "خزائن",
                "name_fr" => "Commodes",
                "description" => "Storage furniture for bedrooms.",
            ],
            [
                "parent" => "Garden & Outdoor",
                "name" => "Patio Sofas",
                "name_ar" => "كنب خارجي",
                "name_fr" => "Canapés de Patio",
                "description" => "Outdoor seating furniture.",
            ],
            [
                "parent" => "Home & Garden",
                "name" => "Nursery",
                "name_ar" => "حضانة",
                "name_fr" => "Chambre Bébé",
                "description" => "Furniture and items for babies and toddlers.",
            ],
            [
                "parent" => "Kitchen & Dining",
                "name" => "Kitchen",
                "name_ar" => "مطبخ",
                "name_fr" => "Cuisine",
                "description" => "Kitchen essentials and accessories.",
            ],
            [
                "parent" => "Furniture",
                "name" => "Accent Furniture",
                "name_ar" => "أثاث زخرفي",
                "name_fr" => "Meubles d'Accent",
                "description" => "Decorative furniture pieces.",
            ],
            [
                "parent" => "Tools & Equipment",
                "name" => "Replacement Parts",
                "name_ar" => "قطع غيار",
                "name_fr" => "Pièces de Rechange",
                "description" => "Spare parts for various products.",
            ],
        ];

        foreach ($level3Categories as $catData) {
            $parentName = $catData["parent"];
            $parent = $createdLevel2[$parentName] ?? $createdLevel1[$parentName] ?? null;

            if ($parent) {
                $catData["parent_id"] = $parent->id;
                unset($catData["parent"]); // Remove temporary parent key
                Category::create($catData); // No need to store these for now
            } else {
                // Handle error: parent not found (optional logging)
                $this->command->error(
                    "Parent category '{$parentName}' not found for '{$catData["name"]}'. Skipping."
                );
            }
        }
    }
}
