<?php

namespace Database\Seeders;

use App\Models\BusinessActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class BusinessActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear the table first to avoid duplicate entries if run multiple times
        // Use the model's query builder to delete for consistency and event triggering
        BusinessActivity::query()->delete();

        $activities = [
            ['name' => 'Clothing Retail', 'name_ar' => 'بيع ملابس بالتجزئة', 'name_fr' => 'Vente au détail de vêtements', 'description' => 'Retail stores selling men\'s, women\'s, or children\'s clothing'],
            ['name' => 'Electronics', 'name_ar' => 'إلكترونيات', 'name_fr' => 'Électronique', 'description' => 'Selling electronic devices such as phones and computers'],
            ['name' => 'Groceries', 'name_ar' => 'بقالة', 'name_fr' => 'Épicerie', 'description' => 'Grocery stores and food supplies'],
            ['name' => 'Home Furniture', 'name_ar' => 'أثاث منزلي', 'name_fr' => 'Meubles de maison', 'description' => 'Selling or renting home furniture'],
            ['name' => 'Pharmacies', 'name_ar' => 'صيدليات', 'name_fr' => 'Pharmacies', 'description' => 'Selling medicines and medical supplies'],
            ['name' => 'Cafes and Restaurants', 'name_ar' => 'مقاهي ومطاعم', 'name_fr' => 'Cafés et Restaurants', 'description' => 'Food and beverage businesses'],
            ['name' => 'Bookstores and Stationery', 'name_ar' => 'مكتبات وقرطاسية', 'name_fr' => 'Librairies et Papeterie', 'description' => 'Selling books, stationery, and school supplies'],
            ['name' => 'Building Materials', 'name_ar' => 'مواد بناء', 'name_fr' => 'Matériaux de construction', 'description' => 'Selling cement, iron, and other building materials'],
            ['name' => 'Logistics Services', 'name_ar' => 'خدمات لوجستية', 'name_fr' => 'Services logistiques', 'description' => 'Shipping, delivery, and freight transport'],
            ['name' => 'Cosmetics and Perfumes', 'name_ar' => 'مستلزمات تجميل وعطور', 'name_fr' => 'Cosmétiques et Parfums', 'description' => 'Selling cosmetics and perfumes'],
            ['name' => 'Sporting Goods', 'name_ar' => 'أدوات رياضية', 'name_fr' => 'Articles de sport', 'description' => 'Selling sports equipment and apparel'],
            ['name' => 'Automotive Services', 'name_ar' => 'خدمات سيارات', 'name_fr' => 'Services automobiles', 'description' => 'Repair workshops, selling spare parts, car rentals'],
            ['name' => 'Real Estate', 'name_ar' => 'عقارات', 'name_fr' => 'Immobilier', 'description' => 'Buying, selling, and renting real estate'],
            ['name' => 'Toys', 'name_ar' => 'ألعاب أطفال', 'name_fr' => 'Jouets pour enfants', 'description' => 'Selling toys and gifts for children'],
            ['name' => 'Educational Services', 'name_ar' => 'خدمات تعليمية', 'name_fr' => 'Services éducatifs', 'description' => 'Training centers, private tutoring'],
            ['name' => 'Travel Agencies', 'name_ar' => 'وكالات سفر', 'name_fr' => 'Agences de voyages', 'description' => 'Organizing trips, booking flights and hotels'],
            ['name' => 'Cleaning Services', 'name_ar' => 'خدمات تنظيف', 'name_fr' => 'Services de nettoyage', 'description' => 'Cleaning homes, offices, and buildings'],
            ['name' => 'Bakery and Pastries', 'name_ar' => 'مخابز وحلويات', 'name_fr' => 'Boulangerie et Pâtisserie', 'description' => 'Selling bread, pastries, and sweets'],
            ['name' => 'Florists', 'name_ar' => 'محلات زهور', 'name_fr' => 'Fleuristes', 'description' => 'Selling flowers and plants, and arranging them'],
            ['name' => 'Laundry Services', 'name_ar' => 'خدمات مغسلة', 'name_fr' => 'Services de blanchisserie', 'description' => 'Washing and ironing clothes'],
            ['name' => 'IT Services and Consulting', 'name_ar' => 'خدمات واستشارات تقنية المعلومات', 'name_fr' => 'Services et conseil en informatique', 'description' => 'Computer maintenance, software development, technical consulting'],
            ['name' => 'Photography Studios', 'name_ar' => 'استوديوهات تصوير', 'name_fr' => 'Studios de photographie', 'description' => 'Photography for events and individuals'],
            ['name' => 'Jewelry Stores', 'name_ar' => 'محلات مجوهرات', 'name_fr' => 'Bijouteries', 'description' => 'Selling gold, jewelry, and watches'],
            ['name' => 'Event Planning', 'name_ar' => 'تنظيم مناسبات', 'name_fr' => 'Organisation d\'événements', 'description' => 'Planning and organizing parties and conferences'],
            ['name' => 'Tailoring and Alterations', 'name_ar' => 'خياطة وتعديل ملابس', 'name_fr' => 'Couture et retouches', 'description' => 'Tailoring and clothing alterations'],
            ['name' => 'Pet Shops and Supplies', 'name_ar' => 'محلات حيوانات أليفة ومستلزماتها', 'name_fr' => 'Animaleries et fournitures', 'description' => 'Selling pets, their food, and accessories'],
            ['name' => 'Gyms and Fitness Centers', 'name_ar' => 'صالات رياضية ومراكز لياقة', 'name_fr' => 'Salles de sport et centres de fitness', 'description' => 'Providing exercise and fitness services'],
            ['name' => 'Printing and Copying Services', 'name_ar' => 'خدمات طباعة ونسخ', 'name_fr' => 'Services d\'impression et de copie', 'description' => 'Printing documents, photocopying, and office services'],
            ['name' => 'Beauty Salons and Spas', 'name_ar' => 'صالونات تجميل ومنتجعات صحية', 'name_fr' => 'Salons de beauté et spas', 'description' => 'Providing hair, skin, and body care services'],
            ['name' => 'Music Stores', 'name_ar' => 'متاجر موسيقى', 'name_fr' => 'Magasins de musique', 'description' => 'Selling musical instruments and recordings'],
            ['name' => 'Art Galleries', 'name_ar' => 'معارض فنية', 'name_fr' => 'Galeries d\'art', 'description' => 'Displaying and selling artworks'],
            ['name' => 'Antiques Shops', 'name_ar' => 'محلات تحف وأنتيكات', 'name_fr' => 'Magasins d\'antiquités', 'description' => 'Buying and selling antiques and collectibles'],
            ['name' => 'Hardware Stores', 'name_ar' => 'محلات عدد وأدوات', 'name_fr' => 'Quincailleries', 'description' => 'Selling tools, equipment, and repair materials'],
            ['name' => 'Tutoring Centers', 'name_ar' => 'مراكز دروس تقوية', 'name_fr' => 'Centres de tutorat', 'description' => 'Providing private tutoring and academic support for students'],
            ['name' => 'Driving Schools', 'name_ar' => 'مدارس تعليم قيادة', 'name_fr' => 'Auto-écoles', 'description' => 'Teaching driving for cars and motorcycles'],
            ['name' => 'Interior Design Services', 'name_ar' => 'خدمات تصميم داخلي', 'name_fr' => 'Services de design d\'intérieur', 'description' => 'Designing and coordinating interior spaces for homes and offices'],
            ['name' => 'Gardening and Landscaping', 'name_ar' => 'خدمات بستنة وتنسيق حدائق', 'name_fr' => 'Jardinage et aménagement paysager', 'description' => 'Designing, planting, and maintaining gardens and green spaces'],
            ['name' => 'Veterinary Clinics', 'name_ar' => 'عيادات بيطرية', 'name_fr' => 'Cliniques vétérinaires', 'description' => 'Providing healthcare for pets'],
            ['name' => 'Child Care Services', 'name_ar' => 'خدمات رعاية أطفال', 'name_fr' => 'Services de garde d\'enfants', 'description' => 'Nurseries and daycare centers for children'],
            ['name' => 'Recruitment Agencies', 'name_ar' => 'وكالات توظيف', 'name_fr' => 'Agences de recrutement', 'description' => 'Helping companies find employees and individuals find jobs'],
            ['name' => 'Financial Services', 'name_ar' => 'خدمات مالية', 'name_fr' => 'Services financiers', 'description' => 'Financial consulting, accounting services, insurance'],
            ['name' => 'Marketing and Advertising Agencies', 'name_ar' => 'وكالات تسويق وإعلان', 'name_fr' => 'Agences de marketing et de publicité', 'description' => 'Developing and implementing marketing and advertising campaigns'],
            ['name' => 'Waste Management Services', 'name_ar' => 'خدمات إدارة نفايات', 'name_fr' => 'Services de gestion des déchets', 'description' => 'Collecting, transporting, and processing waste'],
            ['name' => 'Security Services', 'name_ar' => 'خدمات أمنية', 'name_fr' => 'Services de sécurité', 'description' => 'Guarding, installing security systems, security consulting'],
            ['name' => 'Translation and Interpretation', 'name_ar' => 'خدمات ترجمة وتحرير', 'name_fr' => 'Traduction et interprétation', 'description' => 'Document translation and interpretation services'],

            // Comprehensive Additions
            ['name' => 'Legal Services', 'name_ar' => 'خدمات قانونية', 'name_fr' => 'Services juridiques', 'description' => 'Law firms and legal consulting'],
            ['name' => 'Accounting and Auditing', 'name_ar' => 'محاسبة وتدقيق حسابات', 'name_fr' => 'Comptabilité et audit', 'description' => 'Accounting and financial auditing services for companies and individuals'],
            ['name' => 'Architectural Services', 'name_ar' => 'خدمات هندسة معمارية', 'name_fr' => 'Services d\'architecture', 'description' => 'Designing buildings and supervising construction'],
            ['name' => 'Engineering Consulting', 'name_ar' => 'استشارات هندسية', 'name_fr' => 'Conseil en ingénierie', 'description' => 'Providing various engineering consulting and solutions'],
            ['name' => 'Graphic Design', 'name_ar' => 'تصميم جرافيك', 'name_fr' => 'Conception graphique', 'description' => 'Designing logos, advertising materials, visual identities'],
            ['name' => 'Web Development and Design', 'name_ar' => 'تطوير وتصميم مواقع ويب', 'name_fr' => 'Développement et conception web', 'description' => 'Creating and managing websites and applications'],
            ['name' => 'Software Development', 'name_ar' => 'تطوير برمجيات', 'name_fr' => 'Développement de logiciels', 'description' => 'Creating custom software and applications'],
            ['name' => 'Data Analysis Services', 'name_ar' => 'خدمات تحليل بيانات', 'name_fr' => 'Services d\'analyse de données', 'description' => 'Analyzing data and providing insights for companies'],
            ['name' => 'Digital Marketing', 'name_ar' => 'تسويق رقمي', 'name_fr' => 'Marketing numérique', 'description' => 'Online marketing, social media management, search engine optimization (SEO)'],
            ['name' => 'Public Relations', 'name_ar' => 'علاقات عامة', 'name_fr' => 'Relations publiques', 'description' => 'Managing reputation and relations with media and the public'],
            ['name' => 'Catering Services', 'name_ar' => 'خدمات تموين غذائي', 'name_fr' => 'Services de traiteur', 'description' => 'Providing food and beverages for events and parties'],
            ['name' => 'Event Equipment Rental', 'name_ar' => 'تأجير معدات مناسبات', 'name_fr' => 'Location de matériel événementiel', 'description' => 'Renting tables, chairs, sound and lighting systems for events'],
            ['name' => 'Hotels and Accommodation', 'name_ar' => 'فنادق وأماكن إقامة', 'name_fr' => 'Hôtels et hébergement', 'description' => 'Providing accommodation services for travelers and tourists'],
            ['name' => 'Guesthouses and B&Bs', 'name_ar' => 'بيوت ضيافة و مبيت وإفطار', 'name_fr' => 'Maisons d\'hôtes et chambres d\'hôtes', 'description' => 'Small accommodation places with a personal touch'],
            ['name' => 'Taxi and Ride-Sharing Services', 'name_ar' => 'خدمات سيارات أجرة ومشاركة الركوب', 'name_fr' => 'Services de taxi et de covoiturage', 'description' => 'Transporting passengers within cities'],
            ['name' => 'Bus Transportation Services', 'name_ar' => 'خدمات نقل بالحافلات', 'name_fr' => 'Services de transport par autobus', 'description' => 'Transporting passengers between or within cities via buses'],
            ['name' => 'Freight and Cargo Transport', 'name_ar' => 'نقل بضائع وشحن', 'name_fr' => 'Transport de fret et de marchandises', 'description' => 'Transporting goods by land, sea, and air'],
            ['name' => 'Courier and Delivery Services', 'name_ar' => 'خدمات بريد سريع وتوصيل', 'name_fr' => 'Services de messagerie et de livraison', 'description' => 'Delivering parcels and documents'],
            ['name' => 'Warehousing and Storage', 'name_ar' => 'تخزين ومستودعات', 'name_fr' => 'Entreposage et stockage', 'description' => 'Providing storage spaces for goods'],
            ['name' => 'Manufacturing - Food Processing', 'name_ar' => 'تصنيع - معالجة أغذية', 'name_fr' => 'Fabrication - Transformation alimentaire', 'description' => 'Converting raw agricultural materials into food products'],
            ['name' => 'Manufacturing - Textiles', 'name_ar' => 'تصنيع - منسوجات', 'name_fr' => 'Fabrication - Textiles', 'description' => 'Producing fabrics, clothing, and furnishings'],
            ['name' => 'Manufacturing - Furniture', 'name_ar' => 'تصنيع - أثاث', 'name_fr' => 'Fabrication - Meubles', 'description' => 'Producing home and office furniture'],
            ['name' => 'Manufacturing - Chemicals', 'name_ar' => 'تصنيع - كيماويات', 'name_fr' => 'Fabrication - Produits chimiques', 'description' => 'Producing industrial or consumer chemicals'],
            ['name' => 'Manufacturing - Plastics', 'name_ar' => 'تصنيع - بلاستيك', 'name_fr' => 'Fabrication - Plastiques', 'description' => 'Producing various plastic products'],
            ['name' => 'Printing and Publishing', 'name_ar' => 'طباعة ونشر', 'name_fr' => 'Impression et édition', 'description' => 'Printing books, magazines, newspapers, and promotional materials'],
            ['name' => 'Appliance Repair', 'name_ar' => 'تصليح أجهزة منزلية', 'name_fr' => 'Réparation d\'appareils électroménagers', 'description' => 'Maintaining and repairing household electrical appliances'],
            ['name' => 'Computer Repair', 'name_ar' => 'تصليح حواسيب', 'name_fr' => 'Réparation d\'ordinateurs', 'description' => 'Maintaining and repairing laptops and desktop computers'],
            ['name' => 'Shoe Repair', 'name_ar' => 'تصليح أحذية', 'name_fr' => 'Réparation de chaussures', 'description' => 'Repairing and polishing shoes and leather bags'],
            ['name' => 'Watch Repair', 'name_ar' => 'تصليح ساعات', 'name_fr' => 'Réparation de montres', 'description' => 'Maintaining and repairing all types of watches'],
            ['name' => 'Barbershops', 'name_ar' => 'صالونات حلاقة رجالية', 'name_fr' => 'Salons de coiffure pour hommes', 'description' => 'Providing haircutting, styling, and beard care services for men'],
            ['name' => 'Nail Salons', 'name_ar' => 'صالونات عناية بالأظافر', 'name_fr' => 'Salons de manucure', 'description' => 'Providing nail care, manicure, and pedicure services'],
            ['name' => 'Massage Therapy', 'name_ar' => 'علاج بالمساج', 'name_fr' => 'Massothérapie', 'description' => 'Providing therapeutic and relaxing massage sessions'],
            ['name' => 'Language Schools', 'name_ar' => 'مدارس لغات', 'name_fr' => 'Écoles de langues', 'description' => 'Teaching foreign languages to adults and children'],
            ['name' => 'Music Schools', 'name_ar' => 'مدارس موسيقى', 'name_fr' => 'Écoles de musique', 'description' => 'Teaching musical instrument playing and singing'],
            ['name' => 'Art Schools', 'name_ar' => 'مدارس فنون', 'name_fr' => 'Écoles d\'art', 'description' => 'Teaching painting, sculpture, photography, and other arts'],
            ['name' => 'Dance Studios', 'name_ar' => 'استوديوهات رقص', 'name_fr' => 'Studios de danse', 'description' => 'Teaching various types of dance'],
            ['name' => 'Martial Arts Schools', 'name_ar' => 'مدارس فنون قتالية', 'name_fr' => 'Écoles d\'arts martiaux', 'description' => 'Teaching Karate, Judo, Taekwondo, and others'],
            ['name' => 'Dentists', 'name_ar' => 'أطباء أسنان', 'name_fr' => 'Dentistes', 'description' => 'Oral and dental medicine and surgery clinics'],
            ['name' => 'Opticians and Eyewear Stores', 'name_ar' => 'أخصائيو بصريات ومحلات نظارات', 'name_fr' => 'Opticiens et magasins de lunettes', 'description' => 'Eye exams and selling prescription glasses, sunglasses, and contact lenses'],
            ['name' => 'Physiotherapy Clinics', 'name_ar' => 'عيادات علاج طبيعي', 'name_fr' => 'Cliniques de physiothérapie', 'description' => 'Providing physiotherapy and rehabilitation services'],
            ['name' => 'Alternative Medicine Practitioners', 'name_ar' => 'ممارسو الطب البديل', 'name_fr' => 'Praticiens de médecine alternative', 'description' => 'Providing services such as acupuncture, cupping, homeopathy'],
            ['name' => 'Mental Health Professionals', 'name_ar' => 'أخصائيو صحة نفسية', 'name_fr' => 'Professionnels de la santé mentale', 'description' => 'Psychiatrists, psychotherapists, psychological counselors'],
            ['name' => 'Gift Shops', 'name_ar' => 'محلات هدايا', 'name_fr' => 'Magasins de cadeaux', 'description' => 'Selling souvenirs, antiques, and greeting cards'],
            ['name' => 'Hobby Shops', 'name_ar' => 'محلات هوايات', 'name_fr' => 'Magasins de loisirs créatifs', 'description' => 'Selling hobby supplies such as modeling, knitting, stamp collecting'],
            ['name' => 'Specialty Food Stores', 'name_ar' => 'متاجر أغذية متخصصة', 'name_fr' => 'Magasins d\'alimentation spécialisée', 'description' => 'Selling organic products, gluten-free foods, ethnic ingredients'],
            ['name' => 'Agriculture - Crop Farming', 'name_ar' => 'زراعة - محاصيل حقلية', 'name_fr' => 'Agriculture - Cultures agricoles', 'description' => 'Growing grains, vegetables, and fruits'],
            ['name' => 'Agriculture - Livestock Farming', 'name_ar' => 'زراعة - تربية مواشي', 'name_fr' => 'Agriculture - Élevage de bétail', 'description' => 'Raising cattle, sheep, and poultry for meat, milk, and egg production'],
            ['name' => 'Fishing and Aquaculture', 'name_ar' => 'صيد الأسماك وتربية الأحياء المائية', 'name_fr' => 'Pêche et aquaculture', 'description' => 'Fishing in seas and rivers or raising fish in fish farms'],
            ['name' => 'Forestry and Logging', 'name_ar' => 'حراجة وقطع أخشاب', 'name_fr' => 'Foresterie et exploitation forestière', 'description' => 'Managing forests, logging, and primary wood processing'],
            ['name' => 'Mining and Quarrying', 'name_ar' => 'تعدين ومحاجر', 'name_fr' => 'Exploitation minière et carrières', 'description' => 'Extracting minerals, stones, and building materials from the earth'],
            ['name' => 'Oil and Gas Extraction', 'name_ar' => 'استخراج النفط والغاز', 'name_fr' => 'Extraction de pétrole et de gaz', 'description' => 'Exploring for and extracting oil and natural gas'],
            ['name' => 'Utilities - Electricity Provider', 'name_ar' => 'مرافق - مزود كهرباء', 'name_fr' => 'Services publics - Fournisseur d\'électricité', 'description' => 'Generating, transmitting, and distributing electricity'],
            ['name' => 'Utilities - Water Supply', 'name_ar' => 'مرافق - إمداد مياه', 'name_fr' => 'Services publics - Approvisionnement en eau', 'description' => 'Treating and distributing potable water'],
            ['name' => 'Utilities - Waste Water Treatment', 'name_ar' => 'مرافق - معالجة مياه صرف صحي', 'name_fr' => 'Services publics - Traitement des eaux usées', 'description' => 'Collecting and treating wastewater'],
            ['name' => 'Wholesale Trade', 'name_ar' => 'تجارة بالجملة', 'name_fr' => 'Commerce de gros', 'description' => 'Selling goods in large quantities to retailers or other companies'],
            ['name' => 'Insurance Agencies', 'name_ar' => 'وكالات تأمين', 'name_fr' => 'Agences d\'assurance', 'description' => 'Selling life, property, and health insurance policies'],
            ['name' => 'Pest Control Services', 'name_ar' => 'خدمات مكافحة حشرات', 'name_fr' => 'Services de lutte antiparasitaire', 'description' => 'Pest control for insects and rodents in homes and buildings'],
            ['name' => 'Moving Services', 'name_ar' => 'خدمات نقل أثاث', 'name_fr' => 'Services de déménagement', 'description' => 'Moving furniture and belongings when relocating'],
            ['name' => 'Car Wash and Detailing', 'name_ar' => 'غسيل وتلميع سيارات', 'name_fr' => 'Lavage et esthétique automobile', 'description' => 'Cleaning and polishing cars inside and out'],
            ['name' => 'Locksmith Services', 'name_ar' => 'خدمات أقفال ومفاتيح', 'name_fr' => 'Services de serrurerie', 'description' => 'Installing and repairing locks, copying keys, opening locked doors'],
            ['name' => 'Film and Video Production', 'name_ar' => 'إنتاج أفلام وفيديو', 'name_fr' => 'Production cinématographique et vidéo', 'description' => 'Producing films, TV programs, commercials, and video clips'],
            ['name' => 'Music Production and Recording Studios', 'name_ar' => 'إنتاج موسيقي واستوديوهات تسجيل', 'name_fr' => 'Production musicale et studios d\'enregistrement', 'description' => 'Recording and producing music and audio works'],
            ['name' => 'Radio and Television Broadcasting', 'name_ar' => 'بث إذاعي وتلفزيوني', 'name_fr' => 'Radiodiffusion et télédiffusion', 'description' => 'Operating radio and television stations'],
            ['name' => 'Newspaper and Magazine Publishers', 'name_ar' => 'ناشرو صحف ومجلات', 'name_fr' => 'Éditeurs de journaux et de magazines', 'description' => 'Publishing and distributing printed or digital newspapers and magazines'],
            ['name' => 'Book Publishers', 'name_ar' => 'ناشرو كتب', 'name_fr' => 'Éditeurs de livres', 'description' => 'Publishing and distributing printed or digital books'],
            ['name' => 'Libraries and Archives', 'name_ar' => 'مكتبات وأرشيفات', 'name_fr' => 'Bibliothèques et archives', 'description' => 'Providing access to books, information resources, and archives'],
            ['name' => 'Museums', 'name_ar' => 'متاحف', 'name_fr' => 'Musées', 'description' => 'Displaying historical, artistic, and scientific collections to the public'],
            ['name' => 'Amusement Parks and Arcades', 'name_ar' => 'مدن ملاهي وأروقة ألعاب', 'name_fr' => 'Parcs d\'attractions et salles d\'arcade', 'description' => 'Providing games and recreational activities'],
            ['name' => 'Cinemas', 'name_ar' => 'دور سينما', 'name_fr' => 'Cinémas', 'description' => 'Screening movies for the public'],
            ['name' => 'Theaters and Performing Arts Venues', 'name_ar' => 'مسارح وأماكن فنون أداء', 'name_fr' => 'Théâtres et salles de spectacle', 'description' => 'Presenting theatrical, musical, and dance performances'],
            ['name' => 'Sports Clubs and Facilities', 'name_ar' => 'أندية ومرافق رياضية', 'name_fr' => 'Clubs et installations sportives', 'description' => 'Providing venues for various sports and organizing sporting events'],
            ['name' => 'Religious Organizations', 'name_ar' => 'منظمات دينية', 'name_fr' => 'Organisations religieuses', 'description' => 'Places of worship and religious centers offering spiritual and community services'],
            ['name' => 'Social Advocacy Organizations', 'name_ar' => 'منظمات مناصرة اجتماعية', 'name_fr' => 'Organisations de défense des droits sociaux', 'description' => 'Organizations working on human rights, environmental, and social justice issues'],
            ['name' => 'Charitable Foundations', 'name_ar' => 'مؤسسات خيرية', 'name_fr' => 'Fondations caritatives', 'description' => 'Organizations providing grants and financial support for charitable causes'],
            ['name' => 'Community Centers', 'name_ar' => 'مراكز مجتمعية', 'name_fr' => 'Centres communautaires', 'description' => 'Centers offering recreational and educational programs and activities for the local community'],
            ['name' => 'Other', 'name_ar' => 'أخرى', 'name_fr' => 'Autre', 'description' => 'Business activities not classified under other categories'],
        ];

        // Insert data using the Eloquent model
        foreach ($activities as $activity) {
            BusinessActivity::create($activity);
        }
    }
}