<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder2 extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            [
                'name' => 'Home & Kitchen',
                'name_ar' => 'المنزل والمطبخ',
                'name_fr' => 'Maison et Cuisine',
                'children' => [
                    [
                        'name' => 'Kitchen Appliances',
                        'name_ar' => 'أجهزة المطبخ',
                        'name_fr' => 'Appareils de cuisine',
                        'children' => [
                            ['name' => 'Blenders', 'name_ar' => 'خلاطات', 'name_fr' => 'Mixeurs'],
                            ['name' => 'Coffee Makers', 'name_ar' => 'ماكينات القهوة', 'name_fr' => 'Cafetières'],
                            ['name' => 'Mixers', 'name_ar' => 'أجهزة مزج', 'name_fr' => 'Mélangeurs'],
                            ['name' => 'Toasters', 'name_ar' => 'محمصات', 'name_fr' => 'Grille-pains'],
                            ['name' => 'Air Fryers', 'name_ar' => 'قلايات هوائية', 'name_fr' => 'Friteuses à air'],
                            ['name' => 'Microwaves', 'name_ar' => 'أفران ميكروويف', 'name_fr' => 'Micro-ondes']
                        ]
                    ],
                    [
                        'name' => 'Home Decor',
                        'name_ar' => 'ديكور المنزل',
                        'name_fr' => 'Décoration d\'intérieur',
                        'children' => [
                            ['name' => 'Wall Art', 'name_ar' => 'فن الجدران', 'name_fr' => 'Art mural'],
                            ['name' => 'Candles', 'name_ar' => 'شموع', 'name_fr' => 'Bougies'],
                            ['name' => 'Vases', 'name_ar' => 'مزهرية', 'name_fr' => 'Vases'],
                            ['name' => 'Photo Frames', 'name_ar' => 'إطارات صور', 'name_fr' => 'Cadres photo'],
                            ['name' => 'Mirrors', 'name_ar' => 'مرايا', 'name_fr' => 'Miroirs'],
                            ['name' => 'Cushions', 'name_ar' => 'وسائد', 'name_fr' => 'Coussins']
                        ]
                    ],
                    [
                        'name' => 'Bedroom',
                        'name_ar' => 'غرفة النوم',
                        'name_fr' => 'Chambre à coucher',
                        'children' => [
                            ['name' => 'Bedding Sets', 'name_ar' => 'مجموعات الأسرة', 'name_fr' => 'Parures de lit'],
                            ['name' => 'Pillows', 'name_ar' => 'وسائد', 'name_fr' => 'Oreillers'],
                            ['name' => 'Blankets', 'name_ar' => 'بطانيات', 'name_fr' => 'Couvertures'],
                            ['name' => 'Mattresses', 'name_ar' => 'مراتب', 'name_fr' => 'Matelas'],
                            ['name' => 'Bed Frames', 'name_ar' => 'هياكل الأسرة', 'name_fr' => 'Cadres de lit'],
                            ['name' => 'Storage', 'name_ar' => 'تخزين', 'name_fr' => 'Rangement']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Beauty & Fragrance',
                'name_ar' => 'الجمال والعطور',
                'name_fr' => 'Beauté et Parfums',
                'children' => [
                    ['name' => 'Makeup', 'name_ar' => 'مكياج', 'name_fr' => 'Maquillage', 'children' => [
                        ['name' => 'Mascaras', 'name_ar' => 'مسكارا', 'name_fr' => 'Mascaras'],
                        ['name' => 'Foundations', 'name_ar' => 'كريم أساس', 'name_fr' => 'Fonds de teint'],
                        ['name' => 'Blushers & Bronzers', 'name_ar' => 'أحمر خدود وبرونزر', 'name_fr' => 'Fards à joues et Bronzers'],
                        ['name' => 'Eye Palettes', 'name_ar' => 'لوحات ظلال العيون', 'name_fr' => 'Palettes pour les yeux'],
                        ['name' => 'Lip Glosses', 'name_ar' => 'ملمع شفاه', 'name_fr' => 'Gloss à lèvres'],
                        ['name' => 'Makeup Brushes', 'name_ar' => 'فرش مكياج', 'name_fr' => 'Pinceaux de maquillage'],
                        ['name' => 'Makeup Bags', 'name_ar' => 'حقائب مكياج', 'name_fr' => 'Trousses de maquillage']
                    ]],
                    ['name' => 'Skincare', 'name_ar' => 'العناية بالبشرة', 'name_fr' => 'Soins de la peau', 'children' => [
                        ['name' => 'Moisturizers', 'name_ar' => 'مرطبات', 'name_fr' => 'Hydratants'],
                        ['name' => 'Suncare', 'name_ar' => 'واقي الشمس', 'name_fr' => 'Soins solaires'],
                        ['name' => 'Cleansers', 'name_ar' => 'منظفات', 'name_fr' => 'Nettoyants'],
                        ['name' => 'Bath & Body', 'name_ar' => 'الاستحمام والجسم', 'name_fr' => 'Bain et corps'],
                        ['name' => 'Treatments & Serums', 'name_ar' => 'العلاجات والسيروم', 'name_fr' => 'Traitements et sérums'],
                        ['name' => 'Toners', 'name_ar' => 'تونر', 'name_fr' => 'Toniques'],
                        ['name' => 'Giftsets', 'name_ar' => 'مجموعات هدايا', 'name_fr' => 'Coffrets cadeaux']
                    ]],
                    ['name' => 'Haircare', 'name_ar' => 'العناية بالشعر', 'name_fr' => 'Soins capillaires', 'children' => [
                        ['name' => 'Shampoos', 'name_ar' => 'شامبو', 'name_fr' => 'Shampooings'],
                        ['name' => 'Conditioners', 'name_ar' => 'بلسم', 'name_fr' => 'Après-shampooings'],
                        ['name' => 'Hair Masks', 'name_ar' => 'أقنعة شعر', 'name_fr' => 'Masques capillaires'],
                        ['name' => 'Hair Oils & Serums', 'name_ar' => 'زيوت وسيروم الشعر', 'name_fr' => 'Huiles et sérums capillaires'],
                        ['name' => 'Hair Color', 'name_ar' => 'صبغات الشعر', 'name_fr' => 'Coloration capillaire'],
                        ['name' => 'Hair Loss Products', 'name_ar' => 'منتجات تساقط الشعر', 'name_fr' => 'Produits contre la chute de cheveux'],
                        ['name' => 'Professional Range', 'name_ar' => 'مجموعة احترافية', 'name_fr' => 'Gamme professionnelle']
                    ]],
                    ['name' => 'Fragrance', 'name_ar' => 'العطور', 'name_fr' => 'Parfums', 'children' => [
                        ['name' => 'Women\'s Perfumes', 'name_ar' => 'عطور نسائية', 'name_fr' => 'Parfums pour femmes'],
                        ['name' => 'Men\'s Perfumes', 'name_ar' => 'عطور رجالية', 'name_fr' => 'Parfums pour hommes'],
                        ['name' => 'Arabic Perfumes', 'name_ar' => 'عطور عربية', 'name_fr' => 'Parfums orientaux'],
                        ['name' => 'Gift Sets', 'name_ar' => 'مجموعات هدايا', 'name_fr' => 'Coffrets cadeaux'],
                        ['name' => 'Luxe Fragrances', 'name_ar' => 'عطور فاخرة', 'name_fr' => 'Parfums de luxe'],
                        ['name' => 'Body Mists', 'name_ar' => 'بخاخات للجسم', 'name_fr' => 'Brumes corporelles'],
                        ['name' => 'Bestsellers', 'name_ar' => 'الأكثر مبيعاً', 'name_fr' => 'Meilleures ventes']
                    ]]
                ]
            ],
            [
                'name' => 'Baby',
                'name_ar' => 'الرضع',
                'name_fr' => 'Bébé',
                'children' => [
                    [
                        'name' => 'Baby Essentials',
                        'name_ar' => 'مستلزمات الرضع',
                        'name_fr' => 'Essentiels pour bébé',
                        'children' => [
                            ['name' => 'Bestsellers', 'name_ar' => 'الأكثر مبيعًا', 'name_fr' => 'Meilleures ventes'],
                            ['name' => 'Gifting Store', 'name_ar' => 'متجر الهدايا', 'name_fr' => 'Boutique cadeaux'],
                            ['name' => 'Premium Store', 'name_ar' => 'المتجر المميز', 'name_fr' => 'Boutique premium'],
                            ['name' => 'Clearance', 'name_ar' => 'تصفية', 'name_fr' => 'Liquidation'],
                            ['name' => 'New Arrivals', 'name_ar' => 'الوافدون الجدد', 'name_fr' => 'Nouveautés'],
                            ['name' => 'Car Seat Buying Guide', 'name_ar' => 'دليل شراء كراسي السيارة', 'name_fr' => 'Guide d\'achat des sièges auto'],
                            ['name' => 'Stroller Buying Guide', 'name_ar' => 'دليل شراء عربات الأطفال', 'name_fr' => 'Guide d\'achat des poussettes'],
                            ['name' => 'Hospital Bag Checklist', 'name_ar' => 'قائمة حقيبة المستشفى', 'name_fr' => 'Liste pour sac d\'hôpital']
                        ]
                    ],
                    [
                        'name' => 'Feeding Essentials',
                        'name_ar' => 'مستلزمات التغذية',
                        'name_fr' => 'Essentiels pour l\'alimentation',
                        'children' => [
                            ['name' => 'Breast Pumps', 'name_ar' => 'مضخات الثدي', 'name_fr' => 'Tire-laits'],
                            ['name' => 'Feeding Bottles', 'name_ar' => 'زجاجات الرضاعة', 'name_fr' => 'Biberons'],
                            ['name' => 'Pacifiers & Teethers', 'name_ar' => 'اللهايات وحلقات التسنين', 'name_fr' => 'Sucettes et anneaux de dentition'],
                            ['name' => 'Food Makers', 'name_ar' => 'أجهزة تحضير الطعام', 'name_fr' => 'Préparateurs de nourriture'],
                            ['name' => 'Highchairs & Boosters', 'name_ar' => 'كراسي طعام ومقاعد مرتفعة', 'name_fr' => 'Chaises hautes et rehausseurs'],
                            ['name' => 'Lunch Boxes & Bags', 'name_ar' => 'علب وحقائب الغداء', 'name_fr' => 'Boîtes et sacs à lunch'],
                            ['name' => 'Sterilizers & Warmers', 'name_ar' => 'أجهزة التعقيم والتدفئة', 'name_fr' => 'Stérilisateurs et chauffe-biberons'],
                            ['name' => 'Bibs & Burp Cloths', 'name_ar' => 'مرايل وقطع التجشؤ', 'name_fr' => 'Bavoirs et linges d\'épaule']
                        ]
                    ],
                    [
                        'name' => 'Baby Care',
                        'name_ar' => 'العناية بالرضيع',
                        'name_fr' => 'Soins pour bébé',
                        'children' => [
                            ['name' => 'Diapers', 'name_ar' => 'حفاضات', 'name_fr' => 'Couches'],
                            ['name' => 'Wipes', 'name_ar' => 'مناديل مبللة', 'name_fr' => 'Lingettes'],
                            ['name' => 'Bathing & Skin Care', 'name_ar' => 'الاستحمام والعناية بالبشرة', 'name_fr' => 'Bain et soins de la peau'],
                            ['name' => 'Baby Food', 'name_ar' => 'طعام الرضع', 'name_fr' => 'Nourriture pour bébé'],
                            ['name' => 'Grooming & Health Care', 'name_ar' => 'العناية الصحية والتجميلية', 'name_fr' => 'Toilettage et soins de santé'],
                            ['name' => 'Potty Training', 'name_ar' => 'تدريب على الحمام', 'name_fr' => 'Apprentissage de la propreté'],
                            ['name' => 'Bath Tubs & Seats', 'name_ar' => 'أحواض ومقاعد الاستحمام', 'name_fr' => 'Baignoires et sièges']
                        ]
                    ],
                    [
                        'name' => 'Baby Travel Gear',
                        'name_ar' => 'معدات سفر الأطفال',
                        'name_fr' => 'Équipement de voyage bébé',
                        'children' => [
                            ['name' => 'Strollers', 'name_ar' => 'عربات الأطفال', 'name_fr' => 'Poussettes'],
                            ['name' => 'Car Seats', 'name_ar' => 'كراسي السيارة', 'name_fr' => 'Sièges auto'],
                            ['name' => 'Travel Systems', 'name_ar' => 'أنظمة السفر', 'name_fr' => 'Systèmes de voyage'],
                            ['name' => 'Carrier and Slings', 'name_ar' => 'حمالات وأوشحة الحمل', 'name_fr' => 'Porte-bébés et écharpes'],
                            ['name' => 'Twin Strollers', 'name_ar' => 'عربات مزدوجة', 'name_fr' => 'Poussettes doubles'],
                            ['name' => 'Diaper Bags & Organizers', 'name_ar' => 'حقائب ومنظمات الحفاضات', 'name_fr' => 'Sacs à couches et organisateurs'],
                            ['name' => 'Stroller Accessories', 'name_ar' => 'إكسسوارات العربات', 'name_fr' => 'Accessoires pour poussettes'],
                            ['name' => 'Car Seat Accessories', 'name_ar' => 'إكسسوارات كراسي السيارة', 'name_fr' => 'Accessoires pour sièges auto']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Toys',
                'name_ar' => 'الألعاب',
                'name_fr' => 'Jouets',
                'children' => [
                    [
                        'name' => 'By Age',
                        'name_ar' => 'حسب الفئة العمرية',
                        'name_fr' => 'Par âge',
                        'children' => [
                            ['name' => '0-12 Months', 'name_ar' => 'من 0 إلى 12 شهرًا', 'name_fr' => '0-12 mois'],
                            ['name' => '1-3 Years', 'name_ar' => 'من سنة إلى 3 سنوات', 'name_fr' => '1-3 ans'],
                            ['name' => '3-5 Years', 'name_ar' => 'من 3 إلى 5 سنوات', 'name_fr' => '3-5 ans'],
                            ['name' => '5-8 Years', 'name_ar' => 'من 5 إلى 8 سنوات', 'name_fr' => '5-8 ans'],
                            ['name' => '8-12 Years', 'name_ar' => 'من 8 إلى 12 سنة', 'name_fr' => '8-12 ans'],
                            ['name' => '12+ Years', 'name_ar' => 'أكثر من 12 سنة', 'name_fr' => '12 ans et plus']
                        ]
                    ],
                    [
                        'name' => 'Toy Categories',
                        'name_ar' => 'أنواع الألعاب',
                        'name_fr' => 'Catégories de jouets',
                        'children' => [
                            ['name' => 'Action Figures', 'name_ar' => 'شخصيات مجسمة', 'name_fr' => 'Figurines d’action'],
                            ['name' => 'Dolls & Accessories', 'name_ar' => 'الدمى وإكسسواراتها', 'name_fr' => 'Poupées et accessoires'],
                            ['name' => 'Building Blocks', 'name_ar' => 'مكعبات البناء', 'name_fr' => 'Blocs de construction'],
                            ['name' => 'Arts & Crafts', 'name_ar' => 'الفنون والحِرف', 'name_fr' => 'Arts et bricolage'],
                            ['name' => 'Educational Toys', 'name_ar' => 'ألعاب تعليمية', 'name_fr' => 'Jouets éducatifs'],
                            ['name' => 'Remote Control', 'name_ar' => 'ألعاب بالتحكم عن بُعد', 'name_fr' => 'Télécommandés'],
                            ['name' => 'Board Games', 'name_ar' => 'ألعاب الطاولة', 'name_fr' => 'Jeux de société'],
                            ['name' => 'Outdoor Toys', 'name_ar' => 'ألعاب خارجية', 'name_fr' => 'Jouets d’extérieur']
                        ]
                    ],
                    [
                        'name' => 'Popular Brands',
                        'name_ar' => 'العلامات التجارية الشهيرة',
                        'name_fr' => 'Marques populaires',
                        'children' => [
                            ['name' => 'LEGO', 'name_ar' => 'ليغو', 'name_fr' => 'LEGO'],
                            ['name' => 'Barbie', 'name_ar' => 'باربي', 'name_fr' => 'Barbie'],
                            ['name' => 'Hot Wheels', 'name_ar' => 'هوت ويلز', 'name_fr' => 'Hot Wheels'],
                            ['name' => 'Fisher-Price', 'name_ar' => 'فيشر برايس', 'name_fr' => 'Fisher-Price'],
                            ['name' => 'Playmobil', 'name_ar' => 'بلاي موبيل', 'name_fr' => 'Playmobil'],
                            ['name' => 'Disney', 'name_ar' => 'ديزني', 'name_fr' => 'Disney']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Sports & Outdoors',
                'name_ar' => 'الرياضة والأنشطة الخارجية',
                'name_fr' => 'Sports et plein air',
                'children' => [
                    [
                        'name' => 'Fitness Equipment',
                        'name_ar' => 'معدات اللياقة البدنية',
                        'name_fr' => 'Équipement de fitness',
                        'children' => [
                            ['name' => 'Treadmills', 'name_ar' => 'أجهزة الجري', 'name_fr' => 'Tapis de course'],
                            ['name' => 'Exercise Bikes', 'name_ar' => 'دراجات التمرين', 'name_fr' => 'Vélos d\'appartement'],
                            ['name' => 'Dumbbells', 'name_ar' => 'أثقال يدوية', 'name_fr' => 'Haltères'],
                            ['name' => 'Yoga Mats', 'name_ar' => 'حصائر اليوغا', 'name_fr' => 'Tapis de yoga'],
                            ['name' => 'Resistance Bands', 'name_ar' => 'أشرطة المقاومة', 'name_fr' => 'Bandes de résistance'],
                            ['name' => 'Home Gyms', 'name_ar' => 'أجهزة رياضية منزلية', 'name_fr' => 'Salles de sport à domicile']
                        ]
                    ],
                    [
                        'name' => 'Outdoor Activities',
                        'name_ar' => 'الأنشطة الخارجية',
                        'name_fr' => 'Activités en plein air',
                        'children' => [
                            ['name' => 'Camping Gear', 'name_ar' => 'معدات التخييم', 'name_fr' => 'Équipement de camping'],
                            ['name' => 'Hiking Equipment', 'name_ar' => 'معدات التنزه', 'name_fr' => 'Équipement de randonnée'],
                            ['name' => 'Cycling', 'name_ar' => 'ركوب الدراجات', 'name_fr' => 'Cyclisme'],
                            ['name' => 'Swimming', 'name_ar' => 'السباحة', 'name_fr' => 'Natation'],
                            ['name' => 'Running', 'name_ar' => 'الجري', 'name_fr' => 'Course à pied'],
                            ['name' => 'Sports Apparel', 'name_ar' => 'ملابس رياضية', 'name_fr' => 'Vêtements de sport']
                        ]
                    ],
                    [
                        'name' => 'Team Sports',
                        'name_ar' => 'الرياضات الجماعية',
                        'name_fr' => 'Sports d\'équipe',
                        'children' => [
                            ['name' => 'Football', 'name_ar' => 'كرة القدم الأمريكية', 'name_fr' => 'Football américain'],
                            ['name' => 'Basketball', 'name_ar' => 'كرة السلة', 'name_fr' => 'Basket-ball'],
                            ['name' => 'Soccer', 'name_ar' => 'كرة القدم', 'name_fr' => 'Football'],
                            ['name' => 'Tennis', 'name_ar' => 'التنس', 'name_fr' => 'Tennis'],
                            ['name' => 'Baseball', 'name_ar' => 'البيسبول', 'name_fr' => 'Baseball'],
                            ['name' => 'Golf', 'name_ar' => 'الغولف', 'name_fr' => 'Golf']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Electronics',
                'name_ar' => 'الإلكترونيات',
                'name_fr' => 'Électronique',
                'children' => [
                    [
                        'name' => 'Mobile & Accessories',
                        'name_ar' => 'الهواتف والإكسسوارات',
                        'name_fr' => 'Mobiles et accessoires',
                        'children' => [
                            ['name' => 'Smartphones', 'name_ar' => 'الهواتف الذكية', 'name_fr' => 'Smartphones'],
                            ['name' => 'Phone Cases', 'name_ar' => 'أغطية الهواتف', 'name_fr' => 'Coques de téléphone'],
                            ['name' => 'Screen Protectors', 'name_ar' => 'واقيات الشاشة', 'name_fr' => 'Protecteurs d\'écran'],
                            ['name' => 'Chargers & Cables', 'name_ar' => 'الشواحن والكابلات', 'name_fr' => 'Chargeurs et câbles'],
                            ['name' => 'Power Banks', 'name_ar' => 'الباور بانك', 'name_fr' => 'Batteries externes'],
                            ['name' => 'Wireless Earbuds', 'name_ar' => 'سماعات أذن لاسلكية', 'name_fr' => 'Écouteurs sans fil']
                        ]
                    ],
                    [
                        'name' => 'Computing',
                        'name_ar' => 'أجهزة الحاسوب',
                        'name_fr' => 'Informatique',
                        'children' => [
                            ['name' => 'Laptops', 'name_ar' => 'أجهزة لابتوب', 'name_fr' => 'Ordinateurs portables'],
                            ['name' => 'Tablets', 'name_ar' => 'الأجهزة اللوحية', 'name_fr' => 'Tablettes'],
                            ['name' => 'Desktop Computers', 'name_ar' => 'أجهزة الكمبيوتر المكتبية', 'name_fr' => 'Ordinateurs de bureau'],
                            ['name' => 'Monitors', 'name_ar' => 'الشاشات', 'name_fr' => 'Moniteurs'],
                            ['name' => 'Keyboards & Mice', 'name_ar' => 'لوحات المفاتيح والفأرات', 'name_fr' => 'Claviers et souris'],
                            ['name' => 'Storage Devices', 'name_ar' => 'أجهزة التخزين', 'name_fr' => 'Périphériques de stockage']
                        ]
                    ],
                    [
                        'name' => 'Audio & Video',
                        'name_ar' => 'الصوتيات والمرئيات',
                        'name_fr' => 'Audio et vidéo',
                        'children' => [
                            ['name' => 'Headphones', 'name_ar' => 'سماعات رأس', 'name_fr' => 'Casques audio'],
                            ['name' => 'Speakers', 'name_ar' => 'مكبرات صوت', 'name_fr' => 'Haut-parleurs'],
                            ['name' => 'Smart TVs', 'name_ar' => 'تلفزيونات ذكية', 'name_fr' => 'Téléviseurs intelligents'],
                            ['name' => 'Streaming Devices', 'name_ar' => 'أجهزة البث المباشر', 'name_fr' => 'Appareils de streaming'],
                            ['name' => 'Sound Bars', 'name_ar' => 'مكبرات الصوت الشريطية', 'name_fr' => 'Barres de son'],
                            ['name' => 'Home Theater', 'name_ar' => 'أنظمة المسرح المنزلي', 'name_fr' => 'Cinéma maison']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Fashion & Clothing',
                'name_ar' => 'الأزياء والملابس',
                'name_fr' => 'Mode et Vêtements',
                'children' => [
                    [
                        'name' => 'Women\'s Fashion',
                        'name_ar' => 'أزياء نسائية',
                        'name_fr' => 'Mode femme',
                        'children' => [
                            ['name' => 'Dresses', 'name_ar' => 'فساتين', 'name_fr' => 'Robes'],
                            ['name' => 'Tops & Blouses', 'name_ar' => 'قمصان وبلوزات', 'name_fr' => 'Tops et chemisiers'],
                            ['name' => 'Jeans & Pants', 'name_ar' => 'جينز وبناطيل', 'name_fr' => 'Jeans et pantalons'],
                            ['name' => 'Skirts', 'name_ar' => 'تنانير', 'name_fr' => 'Jupes'],
                            ['name' => 'Lingerie', 'name_ar' => 'ملابس داخلية', 'name_fr' => 'Lingerie'],
                            ['name' => 'Handbags', 'name_ar' => 'حقائب يد', 'name_fr' => 'Sacs à main']
                        ]
                    ],
                    [
                        'name' => 'Men\'s Fashion',
                        'name_ar' => 'أزياء رجالية',
                        'name_fr' => 'Mode homme',
                        'children' => [
                            ['name' => 'Shirts', 'name_ar' => 'قمصان', 'name_fr' => 'Chemises'],
                            ['name' => 'T-Shirts', 'name_ar' => 'تيشيرتات', 'name_fr' => 'T-shirts'],
                            ['name' => 'Jeans & Pants', 'name_ar' => 'جينز وبناطيل', 'name_fr' => 'Jeans et pantalons'],
                            ['name' => 'Suits', 'name_ar' => 'بدلات', 'name_fr' => 'Costumes'],
                            ['name' => 'Underwear', 'name_ar' => 'ملابس داخلية', 'name_fr' => 'Sous-vêtements'],
                            ['name' => 'Accessories', 'name_ar' => 'إكسسوارات', 'name_fr' => 'Accessoires']
                        ]
                    ],
                    [
                        'name' => 'Shoes & Footwear',
                        'name_ar' => 'الأحذية',
                        'name_fr' => 'Chaussures',
                        'children' => [
                            ['name' => 'Sneakers', 'name_ar' => 'أحذية رياضية', 'name_fr' => 'Baskets'],
                            ['name' => 'Boots', 'name_ar' => 'أحذية طويلة', 'name_fr' => 'Bottes'],
                            ['name' => 'Sandals', 'name_ar' => 'صنادل', 'name_fr' => 'Sandales'],
                            ['name' => 'Formal Shoes', 'name_ar' => 'أحذية رسمية', 'name_fr' => 'Chaussures habillées'],
                            ['name' => 'Athletic Shoes', 'name_ar' => 'أحذية رياضية احترافية', 'name_fr' => 'Chaussures de sport'],
                            ['name' => 'Heels', 'name_ar' => 'كعوب عالية', 'name_fr' => 'Talons']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Automotive',
                'name_ar' => 'السيارات',
                'name_fr' => 'Automobile',
                'children' => [
                    [
                        'name' => 'Car Accessories',
                        'name_ar' => 'إكسسوارات السيارة',
                        'name_fr' => 'Accessoires auto',
                        'children' => [
                            ['name' => 'Car Chargers', 'name_ar' => 'شواحن السيارة', 'name_fr' => 'Chargeurs de voiture'],
                            ['name' => 'Phone Mounts', 'name_ar' => 'حوامل الهاتف', 'name_fr' => 'Supports téléphoniques'],
                            ['name' => 'Seat Covers', 'name_ar' => 'أغطية المقاعد', 'name_fr' => 'Housses de siège'],
                            ['name' => 'Floor Mats', 'name_ar' => 'فرش أرضية السيارة', 'name_fr' => 'Tapis de sol'],
                            ['name' => 'Dashboard Cameras', 'name_ar' => 'كاميرات الطبلون', 'name_fr' => 'Caméras de tableau de bord'],
                            ['name' => 'Air Fresheners', 'name_ar' => 'معطرات الجو', 'name_fr' => 'Désodorisants']
                        ]
                    ],
                    [
                        'name' => 'Car Care',
                        'name_ar' => 'العناية بالسيارة',
                        'name_fr' => 'Entretien auto',
                        'children' => [
                            ['name' => 'Car Wash', 'name_ar' => 'غسيل السيارات', 'name_fr' => 'Lavage de voiture'],
                            ['name' => 'Car Wax', 'name_ar' => 'شمع السيارة', 'name_fr' => 'Cire auto'],
                            ['name' => 'Tire Care', 'name_ar' => 'العناية بالإطارات', 'name_fr' => 'Entretien des pneus'],
                            ['name' => 'Engine Oil', 'name_ar' => 'زيت المحرك', 'name_fr' => 'Huile moteur'],
                            ['name' => 'Brake Fluid', 'name_ar' => 'سائل الفرامل', 'name_fr' => 'Liquide de frein'],
                            ['name' => 'Cleaning Tools', 'name_ar' => 'أدوات التنظيف', 'name_fr' => 'Outils de nettoyage']
                        ]
                    ],
                    [
                        'name' => 'Car Parts',
                        'name_ar' => 'قطع غيار السيارات',
                        'name_fr' => 'Pièces détachées',
                        'children' => [
                            ['name' => 'Brake Pads', 'name_ar' => 'وسائد الفرامل', 'name_fr' => 'Plaquettes de frein'],
                            ['name' => 'Air Filters', 'name_ar' => 'فلاتر الهواء', 'name_fr' => 'Filtres à air'],
                            ['name' => 'Spark Plugs', 'name_ar' => 'شمعات الإشعال', 'name_fr' => 'Bougies d\'allumage'],
                            ['name' => 'Batteries', 'name_ar' => 'بطاريات', 'name_fr' => 'Batteries'],
                            ['name' => 'Headlights', 'name_ar' => 'المصابيح الأمامية', 'name_fr' => 'Phares'],
                            ['name' => 'Wipers', 'name_ar' => 'مسّاحات الزجاج', 'name_fr' => 'Essuie-glaces']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Sports & Fitness',
                'name_ar' => 'الرياضة واللياقة البدنية',
                'name_fr' => 'Sport et remise en forme',
                'children' => [
                    [
                        'name' => 'Fitness Equipment',
                        'name_ar' => 'معدات اللياقة البدنية',
                        'name_fr' => 'Équipement de fitness',
                        'children' => [
                            ['name' => 'Dumbbells', 'name_ar' => 'أثقال يدوية', 'name_fr' => 'Haltères'],
                            ['name' => 'Resistance Bands', 'name_ar' => 'أشرطة المقاومة', 'name_fr' => 'Bandes de résistance'],
                            ['name' => 'Yoga Mats', 'name_ar' => 'حصائر اليوغا', 'name_fr' => 'Tapis de yoga'],
                            ['name' => 'Treadmills', 'name_ar' => 'أجهزة الجري', 'name_fr' => 'Tapis de course'],
                            ['name' => 'Exercise Bikes', 'name_ar' => 'دراجات التمرين', 'name_fr' => 'Vélos d\'appartement'],
                            ['name' => 'Kettlebells', 'name_ar' => 'كرات الحديد', 'name_fr' => 'Kettlebells']
                        ]
                    ],
                    [
                        'name' => 'Sports Gear',
                        'name_ar' => 'معدات رياضية',
                        'name_fr' => 'Équipement de sport',
                        'children' => [
                            ['name' => 'Basketball', 'name_ar' => 'كرة السلة', 'name_fr' => 'Basket-ball'],
                            ['name' => 'Football', 'name_ar' => 'كرة القدم', 'name_fr' => 'Football'],
                            ['name' => 'Tennis', 'name_ar' => 'التنس', 'name_fr' => 'Tennis'],
                            ['name' => 'Swimming', 'name_ar' => 'السباحة', 'name_fr' => 'Natation'],
                            ['name' => 'Cycling', 'name_ar' => 'ركوب الدراجات', 'name_fr' => 'Cyclisme'],
                            ['name' => 'Running', 'name_ar' => 'الجري', 'name_fr' => 'Course à pied']
                        ]
                    ],
                    [
                        'name' => 'Activewear',
                        'name_ar' => 'ملابس رياضية',
                        'name_fr' => 'Vêtements de sport',
                        'children' => [
                            ['name' => 'Athletic Shirts', 'name_ar' => 'قمصان رياضية', 'name_fr' => 'T-shirts de sport'],
                            ['name' => 'Sports Bras', 'name_ar' => 'صدريات رياضية', 'name_fr' => 'Brassières de sport'],
                            ['name' => 'Leggings', 'name_ar' => 'ليجنز', 'name_fr' => 'Leggings'],
                            ['name' => 'Shorts', 'name_ar' => 'شورتات', 'name_fr' => 'Shorts'],
                            ['name' => 'Hoodies', 'name_ar' => 'هوديز', 'name_fr' => 'Sweat-shirts à capuche'],
                            ['name' => 'Track Suits', 'name_ar' => 'بدلات رياضية', 'name_fr' => 'Survêtements']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Books & Media',
                'name_ar' => 'الكتب والوسائط',
                'name_fr' => 'Livres et médias',
                'children' => [
                    [
                        'name' => 'Books',
                        'name_ar' => 'الكتب',
                        'name_fr' => 'Livres',
                        'children' => [
                            ['name' => 'Fiction', 'name_ar' => 'روايات خيالية', 'name_fr' => 'Fiction'],
                            ['name' => 'Non-Fiction', 'name_ar' => 'كتب غير خيالية', 'name_fr' => 'Non-fiction'],
                            ['name' => 'Self-Help', 'name_ar' => 'تطوير الذات', 'name_fr' => 'Développement personnel'],
                            ['name' => 'Business', 'name_ar' => 'الأعمال', 'name_fr' => 'Affaires'],
                            ['name' => 'Science', 'name_ar' => 'العلوم', 'name_fr' => 'Science'],
                            ['name' => 'Children\'s Books', 'name_ar' => 'كتب الأطفال', 'name_fr' => 'Livres pour enfants']
                        ]
                    ],
                    [
                        'name' => 'Digital Media',
                        'name_ar' => 'الوسائط الرقمية',
                        'name_fr' => 'Médias numériques',
                        'children' => [
                            ['name' => 'E-Books', 'name_ar' => 'كتب إلكترونية', 'name_fr' => 'Livres électroniques'],
                            ['name' => 'Audiobooks', 'name_ar' => 'كتب صوتية', 'name_fr' => 'Livres audio'],
                            ['name' => 'Music Downloads', 'name_ar' => 'تحميل الموسيقى', 'name_fr' => 'Téléchargement de musique'],
                            ['name' => 'Movies & TV', 'name_ar' => 'أفلام وتلفزيون', 'name_fr' => 'Films et TV'],
                            ['name' => 'Games', 'name_ar' => 'ألعاب', 'name_fr' => 'Jeux'],
                            ['name' => 'Software', 'name_ar' => 'برامج', 'name_fr' => 'Logiciels']
                        ]
                    ],
                    [
                        'name' => 'Educational',
                        'name_ar' => 'التعليمية',
                        'name_fr' => 'Éducatif',
                        'children' => [
                            ['name' => 'Textbooks', 'name_ar' => 'كتب دراسية', 'name_fr' => 'Manuels scolaires'],
                            ['name' => 'Online Courses', 'name_ar' => 'دورات عبر الإنترنت', 'name_fr' => 'Cours en ligne'],
                            ['name' => 'Language Learning', 'name_ar' => 'تعلم اللغات', 'name_fr' => 'Apprentissage des langues'],
                            ['name' => 'Programming', 'name_ar' => 'البرمجة', 'name_fr' => 'Programmation'],
                            ['name' => 'Art & Design', 'name_ar' => 'الفن والتصميم', 'name_fr' => 'Art et design'],
                            ['name' => 'Music Theory', 'name_ar' => 'نظريات الموسيقى', 'name_fr' => 'Théorie musicale']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Garden & Outdoor',
                'name_ar' => 'الحديقة والهواء الطلق',
                'name_fr' => 'Jardin et plein air',
                'children' => [
                    [
                        'name' => 'Gardening',
                        'name_ar' => 'البستنة',
                        'name_fr' => 'Jardinage',
                        'children' => [
                            ['name' => 'Seeds & Plants', 'name_ar' => 'البذور والنباتات', 'name_fr' => 'Graines et plantes'],
                            ['name' => 'Garden Tools', 'name_ar' => 'أدوات الحديقة', 'name_fr' => 'Outils de jardin'],
                            ['name' => 'Fertilizers', 'name_ar' => 'الأسمدة', 'name_fr' => 'Engrais'],
                            ['name' => 'Pots & Planters', 'name_ar' => 'أصص وزارعات', 'name_fr' => 'Pots et jardinières'],
                            ['name' => 'Watering Equipment', 'name_ar' => 'معدات الري', 'name_fr' => 'Équipement d\'arrosage'],
                            ['name' => 'Lawn Care', 'name_ar' => 'العناية بالعشب', 'name_fr' => 'Entretien de la pelouse']
                        ]
                    ],
                    [
                        'name' => 'Outdoor Furniture',
                        'name_ar' => 'الأثاث الخارجي',
                        'name_fr' => 'Mobilier d\'extérieur',
                        'children' => [
                            ['name' => 'Patio Sets', 'name_ar' => 'مجموعات الباحات', 'name_fr' => 'Ensembles de patio'],
                            ['name' => 'Outdoor Chairs', 'name_ar' => 'كراسي خارجية', 'name_fr' => 'Chaises d\'extérieur'],
                            ['name' => 'Umbrellas', 'name_ar' => 'مظلات', 'name_fr' => 'Parapluies'],
                            ['name' => 'Fire Pits', 'name_ar' => 'مواقد نار', 'name_fr' => 'Foyers'],
                            ['name' => 'Gazebos', 'name_ar' => 'شرفات الحديقة', 'name_fr' => 'Kiosques'],
                            ['name' => 'Outdoor Storage', 'name_ar' => 'تخزين خارجي', 'name_fr' => 'Rangement extérieur']
                        ]
                    ],
                    [
                        'name' => 'BBQ & Grilling',
                        'name_ar' => 'الشواء والشوايات',
                        'name_fr' => 'Barbecue et grillades',
                        'children' => [
                            ['name' => 'Gas Grills', 'name_ar' => 'شوايات الغاز', 'name_fr' => 'Barbecues à gaz'],
                            ['name' => 'Charcoal Grills', 'name_ar' => 'شوايات الفحم', 'name_fr' => 'Barbecues au charbon'],
                            ['name' => 'BBQ Tools', 'name_ar' => 'أدوات الشواء', 'name_fr' => 'Ustensiles pour barbecue'],
                            ['name' => 'Outdoor Cooking', 'name_ar' => 'الطهي في الهواء الطلق', 'name_fr' => 'Cuisine en plein air'],
                            ['name' => 'Smokers', 'name_ar' => 'أفران تدخين', 'name_fr' => 'Fumoirs'],
                            ['name' => 'Grill Covers', 'name_ar' => 'أغطية الشوايات', 'name_fr' => 'Housses de gril']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Health & Wellness',
                'name_ar' => 'الصحة والعافية',
                'name_fr' => 'Santé et bien-être',
                'children' => [
                    [
                        'name' => 'Supplements',
                        'name_ar' => 'المكملات الغذائية',
                        'name_fr' => 'Compléments alimentaires',
                        'children' => [
                            ['name' => 'Vitamins', 'name_ar' => 'الفيتامينات', 'name_fr' => 'Vitamines'],
                            ['name' => 'Protein Powder', 'name_ar' => 'مسحوق البروتين', 'name_fr' => 'Poudre de protéines'],
                            ['name' => 'Omega-3', 'name_ar' => 'أوميغا 3', 'name_fr' => 'Oméga-3'],
                            ['name' => 'Probiotics', 'name_ar' => 'البروبيوتيك', 'name_fr' => 'Probiotiques'],
                            ['name' => 'Minerals', 'name_ar' => 'المعادن', 'name_fr' => 'Minéraux'],
                            ['name' => 'Herbal Supplements', 'name_ar' => 'مكملات عشبية', 'name_fr' => 'Compléments à base de plantes']
                        ]
                    ],
                    [
                        'name' => 'Medical Devices',
                        'name_ar' => 'الأجهزة الطبية',
                        'name_fr' => 'Appareils médicaux',
                        'children' => [
                            ['name' => 'Blood Pressure Monitors', 'name_ar' => 'أجهزة قياس ضغط الدم', 'name_fr' => 'Tensiomètres'],
                            ['name' => 'Thermometers', 'name_ar' => 'مقاييس الحرارة', 'name_fr' => 'Thermomètres'],
                            ['name' => 'Pulse Oximeters', 'name_ar' => 'أجهزة قياس النبض والأكسجين', 'name_fr' => 'Oxymètres de pouls'],
                            ['name' => 'Nebulizers', 'name_ar' => 'أجهزة التبخير', 'name_fr' => 'Nébuliseurs'],
                            ['name' => 'First Aid Kits', 'name_ar' => 'حقائب الإسعافات الأولية', 'name_fr' => 'Kits de premiers secours'],
                            ['name' => 'Mobility Aids', 'name_ar' => 'أدوات مساعدة على الحركة', 'name_fr' => 'Aides à la mobilité']
                        ]
                    ],
                    [
                        'name' => 'Personal Care',
                        'name_ar' => 'العناية الشخصية',
                        'name_fr' => 'Soins personnels',
                        'children' => [
                            ['name' => 'Oral Care', 'name_ar' => 'العناية بالفم', 'name_fr' => 'Hygiène bucco-dentaire'],
                            ['name' => 'Hand Sanitizers', 'name_ar' => 'معقمات اليدين', 'name_fr' => 'Désinfectants pour les mains'],
                            ['name' => 'Face Masks', 'name_ar' => 'أقنعة الوجه', 'name_fr' => 'Masques faciaux'],
                            ['name' => 'Massage Tools', 'name_ar' => 'أدوات التدليك', 'name_fr' => 'Outils de massage'],
                            ['name' => 'Sleep Aids', 'name_ar' => 'مساعدات النوم', 'name_fr' => 'Aides au sommeil'],
                            ['name' => 'Pain Relief', 'name_ar' => 'تخفيف الآلام', 'name_fr' => 'Soulagement de la douleur']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Pet Supplies',
                'name_ar' => 'مستلزمات الحيوانات الأليفة',
                'name_fr' => 'Fournitures pour animaux',
                'children' => [
                    [
                        'name' => 'Dog Supplies',
                        'name_ar' => 'مستلزمات الكلاب',
                        'name_fr' => 'Articles pour chiens',
                        'children' => [
                            ['name' => 'Dog Food', 'name_ar' => 'طعام الكلاب', 'name_fr' => 'Nourriture pour chiens'],
                            ['name' => 'Dog Toys', 'name_ar' => 'ألعاب الكلاب', 'name_fr' => 'Jouets pour chiens'],
                            ['name' => 'Dog Beds', 'name_ar' => 'أسِرَّة للكلاب', 'name_fr' => 'Lits pour chiens'],
                            ['name' => 'Dog Collars', 'name_ar' => 'أطواق الكلاب', 'name_fr' => 'Colliers pour chiens'],
                            ['name' => 'Dog Treats', 'name_ar' => 'مكافآت الكلاب', 'name_fr' => 'Friandises pour chiens'],
                            ['name' => 'Dog Grooming', 'name_ar' => 'تجميل الكلاب', 'name_fr' => 'Toilettage pour chiens']
                        ]
                    ],
                    [
                        'name' => 'Cat Supplies',
                        'name_ar' => 'مستلزمات القطط',
                        'name_fr' => 'Articles pour chats',
                        'children' => [
                            ['name' => 'Cat Food', 'name_ar' => 'طعام القطط', 'name_fr' => 'Nourriture pour chats'],
                            ['name' => 'Cat Litter', 'name_ar' => 'رمل القطط', 'name_fr' => 'Litière pour chats'],
                            ['name' => 'Cat Toys', 'name_ar' => 'ألعاب القطط', 'name_fr' => 'Jouets pour chats'],
                            ['name' => 'Scratching Posts', 'name_ar' => 'أعمدة الخدش', 'name_fr' => 'Griffoirs'],
                            ['name' => 'Cat Treats', 'name_ar' => 'مكافآت القطط', 'name_fr' => 'Friandises pour chats'],
                            ['name' => 'Cat Carriers', 'name_ar' => 'حاملات القطط', 'name_fr' => 'Caisses de transport pour chats']
                        ]
                    ],
                    [
                        'name' => 'Small Pets',
                        'name_ar' => 'الحيوانات الصغيرة',
                        'name_fr' => 'Petits animaux',
                        'children' => [
                            ['name' => 'Bird Supplies', 'name_ar' => 'مستلزمات الطيور', 'name_fr' => 'Articles pour oiseaux'],
                            ['name' => 'Fish & Aquarium', 'name_ar' => 'الأسماك والأحواض', 'name_fr' => 'Poissons et aquariums'],
                            ['name' => 'Hamster Supplies', 'name_ar' => 'مستلزمات الهامستر', 'name_fr' => 'Articles pour hamsters'],
                            ['name' => 'Rabbit Supplies', 'name_ar' => 'مستلزمات الأرانب', 'name_fr' => 'Articles pour lapins'],
                            ['name' => 'Reptile Supplies', 'name_ar' => 'مستلزمات الزواحف', 'name_fr' => 'Articles pour reptiles'],
                            ['name' => 'Cages & Habitats', 'name_ar' => 'أقفاص ومساكن', 'name_fr' => 'Cages et habitats']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Office & Stationery',
                'name_ar' => 'المكتب والقرطاسية',
                'name_fr' => 'Bureau et papeterie',
                'children' => [
                    [
                        'name' => 'Office Supplies',
                        'name_ar' => 'اللوازم المكتبية',
                        'name_fr' => 'Fournitures de bureau',
                        'children' => [
                            ['name' => 'Pens & Pencils', 'name_ar' => 'أقلام و أقلام رصاص', 'name_fr' => 'Stylos et crayons'],
                            ['name' => 'Notebooks', 'name_ar' => 'دفاتر', 'name_fr' => 'Cahiers'],
                            ['name' => 'Binders & Folders', 'name_ar' => 'مجلدات وملفات', 'name_fr' => 'Classeurs et dossiers'],
                            ['name' => 'Staplers', 'name_ar' => 'دباسات', 'name_fr' => 'Agrafeuses'],
                            ['name' => 'Paper', 'name_ar' => 'ورق', 'name_fr' => 'Papier'],
                            ['name' => 'Calculators', 'name_ar' => 'آلات حاسبة', 'name_fr' => 'Calculatrices']
                        ]
                    ],
                    [
                        'name' => 'Office Furniture',
                        'name_ar' => 'أثاث مكتبي',
                        'name_fr' => 'Mobilier de bureau',
                        'children' => [
                            ['name' => 'Office Chairs', 'name_ar' => 'كراسي المكتب', 'name_fr' => 'Chaises de bureau'],
                            ['name' => 'Desks', 'name_ar' => 'مكاتب', 'name_fr' => 'Bureaux'],
                            ['name' => 'Filing Cabinets', 'name_ar' => 'خزائن ملفات', 'name_fr' => 'Classeurs à dossiers'],
                            ['name' => 'Bookcases', 'name_ar' => 'خزائن كتب', 'name_fr' => 'Bibliothèques'],
                            ['name' => 'Desk Lamps', 'name_ar' => 'مصابيح المكتب', 'name_fr' => 'Lampes de bureau'],
                            ['name' => 'Office Storage', 'name_ar' => 'تخزين مكتبي', 'name_fr' => 'Rangements de bureau']
                        ]
                    ],
                    [
                        'name' => 'Technology',
                        'name_ar' => 'التقنيات المكتبية',
                        'name_fr' => 'Technologie',
                        'children' => [
                            ['name' => 'Printers', 'name_ar' => 'الطابعات', 'name_fr' => 'Imprimantes'],
                            ['name' => 'Scanners', 'name_ar' => 'الماسحات الضوئية', 'name_fr' => 'Scanneurs'],
                            ['name' => 'Shredders', 'name_ar' => 'آلات تمزيق الورق', 'name_fr' => 'Destructeurs de documents'],
                            ['name' => 'Label Makers', 'name_ar' => 'أجهزة صنع الملصقات', 'name_fr' => 'Étiqueteuses'],
                            ['name' => 'Projectors', 'name_ar' => 'أجهزة عرض', 'name_fr' => 'Projecteurs'],
                            ['name' => 'Whiteboards', 'name_ar' => 'ألواح بيضاء', 'name_fr' => 'Tableaux blancs']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Jewelry & Watches',
                'name_ar' => 'المجوهرات والساعات',
                'name_fr' => 'Bijoux et montres',
                'children' => [
                    [
                        'name' => 'Jewelry',
                        'name_ar' => 'المجوهرات',
                        'name_fr' => 'Bijoux',
                        'children' => [
                            ['name' => 'Necklaces', 'name_ar' => 'قلائد', 'name_fr' => 'Colliers'],
                            ['name' => 'Earrings', 'name_ar' => 'أقراط', 'name_fr' => 'Boucles d\'oreilles'],
                            ['name' => 'Rings', 'name_ar' => 'خواتم', 'name_fr' => 'Bagues'],
                            ['name' => 'Bracelets', 'name_ar' => 'أساور', 'name_fr' => 'Bracelets'],
                            ['name' => 'Brooches', 'name_ar' => 'بروشات', 'name_fr' => 'Broches'],
                            ['name' => 'Jewelry Sets', 'name_ar' => 'طقم مجوهرات', 'name_fr' => 'Parures de bijoux']
                        ]
                    ],
                    [
                        'name' => 'Watches',
                        'name_ar' => 'الساعات',
                        'name_fr' => 'Montres',
                        'children' => [
                            ['name' => 'Men\'s Watches', 'name_ar' => 'ساعات رجالية', 'name_fr' => 'Montres pour hommes'],
                            ['name' => 'Women\'s Watches', 'name_ar' => 'ساعات نسائية', 'name_fr' => 'Montres pour femmes'],
                            ['name' => 'Smart Watches', 'name_ar' => 'ساعات ذكية', 'name_fr' => 'Montres intelligentes'],
                            ['name' => 'Luxury Watches', 'name_ar' => 'ساعات فاخرة', 'name_fr' => 'Montres de luxe'],
                            ['name' => 'Sports Watches', 'name_ar' => 'ساعات رياضية', 'name_fr' => 'Montres sportives'],
                            ['name' => 'Watch Accessories', 'name_ar' => 'إكسسوارات الساعات', 'name_fr' => 'Accessoires de montres']
                        ]
                    ],
                    [
                        'name' => 'Precious Metals',
                        'name_ar' => 'المعادن الثمينة',
                        'name_fr' => 'Métaux précieux',
                        'children' => [
                            ['name' => 'Gold Jewelry', 'name_ar' => 'مجوهرات ذهبية', 'name_fr' => 'Bijoux en or'],
                            ['name' => 'Silver Jewelry', 'name_ar' => 'مجوهرات فضية', 'name_fr' => 'Bijoux en argent'],
                            ['name' => 'Platinum Jewelry', 'name_ar' => 'مجوهرات بلاتين', 'name_fr' => 'Bijoux en platine'],
                            ['name' => 'Diamond Jewelry', 'name_ar' => 'مجوهرات ألماس', 'name_fr' => 'Bijoux en diamant'],
                            ['name' => 'Gemstone Jewelry', 'name_ar' => 'مجوهرات بالأحجار الكريمة', 'name_fr' => 'Bijoux avec pierres précieuses'],
                            ['name' => 'Pearl Jewelry', 'name_ar' => 'مجوهرات لؤلؤ', 'name_fr' => 'Bijoux en perles']
                        ]
                    ]
                ]
            ],
        ];

        $this->insertCategories($categories);
    }

    protected function insertCategories(array $categories, $parentId = null): void
    {
        foreach ($categories as $category) {
            $cat = Category::create([
                'name' => $category['name'],
                'name_ar' => $category['name_ar'],
                'name_fr' => $category['name_fr'],
                'slug' => Str::slug($category['name']),
                'parent_id' => $parentId,
                'description' => $category['description'] ?? null,
            ]);

            if (isset($category['children']) && is_array($category['children'])) {
                $this->insertCategories($category['children'], $cat->id);
            }
        }
    }
}