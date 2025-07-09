// Menu data for the navbar and mega menu
const categories = [
  {
    id: "home-kitchen",
    name: "Home & Kitchen",
    link: "/home-kitchen",
    groups: [
      {
        title: "Kitchen Appliances",
        items: [
          { name: "Blenders", link: "/home-kitchen/blenders" },
          { name: "Coffee Makers", link: "/home-kitchen/coffee-makers" },
          { name: "Mixers", link: "/home-kitchen/mixers" },
          { name: "Toasters", link: "/home-kitchen/toasters" },
          { name: "Air Fryers", link: "/home-kitchen/air-fryers" },
          { name: "Microwaves", link: "/home-kitchen/microwaves" },
        ],
      },
      {
        title: "Home Decor",
        items: [
          { name: "Wall Art", link: "/home-kitchen/wall-art" },
          { name: "Candles", link: "/home-kitchen/candles" },
          { name: "Vases", link: "/home-kitchen/vases" },
          { name: "Photo Frames", link: "/home-kitchen/photo-frames" },
          { name: "Mirrors", link: "/home-kitchen/mirrors" },
          { name: "Cushions", link: "/home-kitchen/cushions" },
        ],
      },
      {
        title: "Bedroom",
        items: [
          { name: "Bedding Sets", link: "/home-kitchen/bedding-sets" },
          { name: "Pillows", link: "/home-kitchen/pillows" },
          { name: "Blankets", link: "/home-kitchen/blankets" },
          { name: "Mattresses", link: "/home-kitchen/mattresses" },
          { name: "Bed Frames", link: "/home-kitchen/bed-frames" },
          { name: "Storage", link: "/home-kitchen/bedroom-storage" },
        ],
      },
    ],
    brands: [
      {
        name: "KitchenAid",
        image: "https://via.placeholder.com/80x40?text=KitchenAid",
        link: "/brands/kitchenaid",
      },
      {
        name: "Dyson",
        image: "https://via.placeholder.com/80x40?text=Dyson",
        link: "/brands/dyson",
      },
      {
        name: "Ikea",
        image: "https://via.placeholder.com/80x40?text=Ikea",
        link: "/brands/ikea",
      },
      {
        name: "Bosch",
        image: "https://via.placeholder.com/80x40?text=Bosch",
        link: "/brands/bosch",
      },
      {
        name: "Philips",
        image: "https://via.placeholder.com/80x40?text=Philips",
        link: "/brands/philips",
      },
    ],
    promoImage:
      "https://images.pexels.com/photos/1080721/pexels-photo-1080721.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2",
    promoTitle: "HOME ESSENTIALS",
  },
  {
    id: "beauty-fragrance",
    name: "Beauty & Fragrance",
    link: "/beauty-fragrance",
    groups: [
      {
        title: "Makeup",
        items: [
          { name: "Mascaras", link: "/beauty-fragrance/mascaras" },
          { name: "Foundations", link: "/beauty-fragrance/foundations" },
          {
            name: "Blushers & bronzers",
            link: "/beauty-fragrance/blushers-bronzers",
          },
          { name: "Eye palettes", link: "/beauty-fragrance/eye-palettes" },
          { name: "Lip glosses", link: "/beauty-fragrance/lip-glosses" },
          { name: "Makeup brushes", link: "/beauty-fragrance/makeup-brushes" },
          { name: "Makeup bags", link: "/beauty-fragrance/makeup-bags" },
        ],
      },
      {
        title: "Skincare",
        items: [
          { name: "Moisturizers", link: "/beauty-fragrance/moisturizers" },
          { name: "Suncare", link: "/beauty-fragrance/suncare" },
          { name: "Cleansers", link: "/beauty-fragrance/cleansers" },
          { name: "Bath & body", link: "/beauty-fragrance/bath-body-skincare" },
          {
            name: "Treatments & serums",
            link: "/beauty-fragrance/treatments-serums",
          },
          { name: "Toners", link: "/beauty-fragrance/toners" },
          { name: "Giftsets", link: "/beauty-fragrance/giftsets" },
        ],
      },
      {
        title: "Haircare",
        items: [
          { name: "Shampoos", link: "/beauty-fragrance/shampoos" },
          { name: "Conditioners", link: "/beauty-fragrance/conditioners" },
          { name: "Hair masks", link: "/beauty-fragrance/hair-masks" },
          {
            name: "Hair oils & serums",
            link: "/beauty-fragrance/hair-oils-serums",
          },
          { name: "Hair color", link: "/beauty-fragrance/hair-color" },
          {
            name: "Hair loss products",
            link: "/beauty-fragrance/hair-loss-products",
          },
          {
            name: "Professional range",
            link: "/beauty-fragrance/professional-range",
          },
        ],
      },
      {
        title: "Fragrance",
        items: [
          {
            name: "Women's perfumes",
            link: "/beauty-fragrance/womens-perfumes",
          },
          { name: "Men's perfumes", link: "/beauty-fragrance/mens-perfumes" },
          {
            name: "Arabic perfumes",
            link: "/beauty-fragrance/arabic-perfumes",
          },
          { name: "Gift sets", link: "/beauty-fragrance/fragrance-gift-sets" },
          {
            name: "Luxe fragrances",
            link: "/beauty-fragrance/luxe-fragrances",
          },
          { name: "Body mists", link: "/beauty-fragrance/body-mists" },
          {
            name: "Bestsellers",
            link: "/beauty-fragrance/fragrance-bestsellers",
          },
        ],
      },
    ],
    brands: [
      {
        name: "L'Oreal",
        image: "https://via.placeholder.com/80x40?text=LOreal",
        link: "/brands/loreal",
      },
      {
        name: "NYX",
        image: "https://via.placeholder.com/80x40?text=NYX",
        link: "/brands/nyx",
      },
      {
        name: "Roberto Cavalli",
        image: "https://via.placeholder.com/80x40?text=Cavalli",
        link: "/brands/roberto-cavalli",
      },
      {
        name: "Bourjois Paris",
        image: "https://via.placeholder.com/80x40?text=Bourjois",
        link: "/brands/bourjois",
      },
      {
        name: "Vichy",
        image: "https://via.placeholder.com/80x40?text=Vichy",
        link: "/brands/vichy",
      },
      {
        name: "Versace",
        image: "https://via.placeholder.com/80x40?text=Versace",
        link: "/brands/versace",
      },
      {
        name: "Philips",
        image: "https://via.placeholder.com/80x40?text=Philips",
        link: "/brands/philips",
      },
      {
        name: "Olaplex",
        image: "https://via.placeholder.com/80x40?text=Olaplex",
        link: "/brands/olaplex",
      },
    ],
    promoImage:
      "https://images.pexels.com/photos/3373739/pexels-photo-3373739.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2",
    promoTitle: "THE BEAUTY EDIT",
  },
  {
    id: "baby",
    name: "Baby",
    link: "/baby",
    groups: [
      {
        title: "Baby essentials",
        items: [
          { name: "Bestsellers", link: "/baby/bestsellers" },
          { name: "Gifting store", link: "/baby/gifting-store" },
          { name: "Premium store", link: "/baby/premium-store" },
          { name: "Clearance", link: "/baby/clearance" },
          { name: "New arrivals", link: "/baby/new-arrivals" },
          {
            name: "Car seat buying guide",
            link: "/baby/car-seat-buying-guide",
          },
          {
            name: "Stroller buying guide",
            link: "/baby/stroller-buying-guide",
          },
          {
            name: "Hospital bag checklist",
            link: "/baby/hospital-bag-checklist",
          },
        ],
      },
      {
        title: "Feeding essentials",
        items: [
          { name: "Breast pumps", link: "/baby/breast-pumps" },
          { name: "Feeding bottles", link: "/baby/feeding-bottles" },
          { name: "Pacifiers & teethers", link: "/baby/pacifiers-teethers" },
          { name: "Food makers", link: "/baby/food-makers" },
          { name: "Highchairs & boosters", link: "/baby/highchairs-boosters" },
          { name: "Lunch boxes & bags", link: "/baby/lunch-boxes-bags" },
          { name: "Sterilizers & warmers", link: "/baby/sterilizers-warmers" },
          { name: "Bibs & burp cloths", link: "/baby/bibs-burp-cloths" },
        ],
      },
      {
        title: "Baby Care",
        items: [
          { name: "Diapers", link: "/baby/diapers" },
          { name: "Wipes", link: "/baby/wipes" },
          { name: "Bathing & skin care", link: "/baby/bathing-skin-care" },
          { name: "Baby food", link: "/baby/baby-food" },
          {
            name: "Grooming & health care",
            link: "/baby/grooming-health-care",
          },
          { name: "Potty training", link: "/baby/potty-training" },
          { name: "Bath tubs & seats", link: "/baby/bath-tubs-seats" },
        ],
      },
      {
        title: "Baby travel gear",
        items: [
          { name: "Strollers", link: "/baby/strollers" },
          { name: "Car seats", link: "/baby/car-seats" },
          { name: "Travel systems", link: "/baby/travel-systems" },
          { name: "Carrier and slings", link: "/baby/carrier-and-slings" },
          { name: "Twin strollers", link: "/baby/twin-strollers" },
          {
            name: "Diaper bags & organizers",
            link: "/baby/diaper-bags-organizers",
          },
          { name: "Stroller accessories", link: "/baby/stroller-accessories" },
          { name: "Car seat accessories", link: "/baby/car-seat-accessories" },
        ],
      },
    ],
    brands: [
      {
        name: "Pampers",
        image: "https://via.placeholder.com/80x40?text=Pampers",
        link: "/brands/pampers",
      },
      {
        name: "Moon",
        image: "https://via.placeholder.com/80x40?text=Moon",
        link: "/brands/moon",
      },
      {
        name: "Nurtur",
        image: "https://via.placeholder.com/80x40?text=Nurtur",
        link: "/brands/nurtur",
      },
      {
        name: "Momcozy",
        image: "https://via.placeholder.com/80x40?text=Momcozy",
        link: "/brands/momcozy",
      },
      {
        name: "Philips Avent",
        image: "https://via.placeholder.com/80x40?text=Philips",
        link: "/brands/philips-avent",
      },
      {
        name: "Tommee Tippee",
        image: "https://via.placeholder.com/80x40?text=Tommee",
        link: "/brands/tommee-tippee",
      },
      {
        name: "Sebamed",
        image: "https://via.placeholder.com/80x40?text=Sebamed",
        link: "/brands/sebamed",
      },
      {
        name: "DrBrowns",
        image: "https://via.placeholder.com/80x40?text=DrBrowns",
        link: "/brands/drbrowns",
      },
    ],
    promoImage:
      "https://images.pexels.com/photos/235127/pexels-photo-235127.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2",
    promoTitle: "EVERYTHING YOUR KID NEEDS",
  },
  {
    id: "toys",
    name: "Toys",
    link: "/toys",
    groups: [
      {
        title: "By Age",
        items: [
          { name: "0-12 Months", link: "/toys/0-12-months" },
          { name: "1-3 Years", link: "/toys/1-3-years" },
          { name: "3-5 Years", link: "/toys/3-5-years" },
          { name: "5-8 Years", link: "/toys/5-8-years" },
          { name: "8-12 Years", link: "/toys/8-12-years" },
          { name: "12+ Years", link: "/toys/12-plus-years" },
        ],
      },
      {
        title: "Toy Categories",
        items: [
          { name: "Action Figures", link: "/toys/action-figures" },
          { name: "Dolls & Accessories", link: "/toys/dolls-accessories" },
          { name: "Building Blocks", link: "/toys/building-blocks" },
          { name: "Arts & Crafts", link: "/toys/arts-crafts" },
          { name: "Educational Toys", link: "/toys/educational" },
          { name: "Remote Control", link: "/toys/remote-control" },
          { name: "Board Games", link: "/toys/board-games" },
          { name: "Outdoor Toys", link: "/toys/outdoor" },
        ],
      },
      {
        title: "Popular Brands",
        items: [
          { name: "LEGO", link: "/toys/lego" },
          { name: "Barbie", link: "/toys/barbie" },
          { name: "Hot Wheels", link: "/toys/hot-wheels" },
          { name: "Fisher-Price", link: "/toys/fisher-price" },
          { name: "Playmobil", link: "/toys/playmobil" },
          { name: "Disney", link: "/toys/disney" },
        ],
      },
    ],
    brands: [
      {
        name: "LEGO",
        image: "https://via.placeholder.com/80x40?text=LEGO",
        link: "/brands/lego",
      },
      {
        name: "Mattel",
        image: "https://via.placeholder.com/80x40?text=Mattel",
        link: "/brands/mattel",
      },
      {
        name: "Hasbro",
        image: "https://via.placeholder.com/80x40?text=Hasbro",
        link: "/brands/hasbro",
      },
      {
        name: "Fisher-Price",
        image: "https://via.placeholder.com/80x40?text=FisherPrice",
        link: "/brands/fisher-price",
      },
      {
        name: "Playmobil",
        image: "https://via.placeholder.com/80x40?text=Playmobil",
        link: "/brands/playmobil",
      },
    ],
    promoImage:
      "https://images.pexels.com/photos/163772/boys-children-dolls-kids-163772.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2",
    promoTitle: "TOYS & GAMES",
  },
  {
    id: "sports",
    name: "Sports & Outdoors",
    link: "/sports",
    groups: [
      {
        title: "Fitness Equipment",
        items: [
          { name: "Treadmills", link: "/sports/treadmills" },
          { name: "Exercise Bikes", link: "/sports/exercise-bikes" },
          { name: "Dumbbells", link: "/sports/dumbbells" },
          { name: "Yoga Mats", link: "/sports/yoga-mats" },
          { name: "Resistance Bands", link: "/sports/resistance-bands" },
          { name: "Home Gyms", link: "/sports/home-gyms" },
        ],
      },
      {
        title: "Outdoor Activities",
        items: [
          { name: "Camping Gear", link: "/sports/camping-gear" },
          { name: "Hiking Equipment", link: "/sports/hiking-equipment" },
          { name: "Cycling", link: "/sports/cycling" },
          { name: "Swimming", link: "/sports/swimming" },
          { name: "Running", link: "/sports/running" },
          { name: "Sports Apparel", link: "/sports/sports-apparel" },
        ],
      },
      {
        title: "Team Sports",
        items: [
          { name: "Football", link: "/sports/football" },
          { name: "Basketball", link: "/sports/basketball" },
          { name: "Soccer", link: "/sports/soccer" },
          { name: "Tennis", link: "/sports/tennis" },
          { name: "Baseball", link: "/sports/baseball" },
          { name: "Golf", link: "/sports/golf" },
        ],
      },
    ],
    brands: [
      {
        name: "Nike",
        image: "https://via.placeholder.com/80x40?text=Nike",
        link: "/brands/nike",
      },
      {
        name: "Adidas",
        image: "https://via.placeholder.com/80x40?text=Adidas",
        link: "/brands/adidas",
      },
      {
        name: "Under Armour",
        image: "https://via.placeholder.com/80x40?text=UnderArmour",
        link: "/brands/under-armour",
      },
      {
        name: "Puma",
        image: "https://via.placeholder.com/80x40?text=Puma",
        link: "/brands/puma",
      },
      {
        name: "Reebok",
        image: "https://via.placeholder.com/80x40?text=Reebok",
        link: "/brands/reebok",
      },
    ],
    promoImage:
      "https://images.pexels.com/photos/841130/pexels-photo-841130.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2",
    promoTitle: "ACTIVE LIFESTYLE",
  },
  {
    id: "electronics",
    name: "Electronics",
    link: "/electronics",
    groups: [
      {
        title: "Mobile & Accessories",
        items: [
          { name: "Smartphones", link: "/electronics/smartphones" },
          { name: "Phone Cases", link: "/electronics/phone-cases" },
          { name: "Screen Protectors", link: "/electronics/screen-protectors" },
          { name: "Chargers & Cables", link: "/electronics/chargers-cables" },
          { name: "Power Banks", link: "/electronics/power-banks" },
          { name: "Wireless Earbuds", link: "/electronics/wireless-earbuds" },
        ],
      },
      {
        title: "Computing",
        items: [
          { name: "Laptops", link: "/electronics/laptops" },
          { name: "Tablets", link: "/electronics/tablets" },
          { name: "Desktop Computers", link: "/electronics/desktop-computers" },
          { name: "Monitors", link: "/electronics/monitors" },
          { name: "Keyboards & Mice", link: "/electronics/keyboards-mice" },
          { name: "Storage Devices", link: "/electronics/storage-devices" },
        ],
      },
      {
        title: "Audio & Video",
        items: [
          { name: "Headphones", link: "/electronics/headphones" },
          { name: "Speakers", link: "/electronics/speakers" },
          { name: "Smart TVs", link: "/electronics/smart-tvs" },
          { name: "Streaming Devices", link: "/electronics/streaming-devices" },
          { name: "Sound Bars", link: "/electronics/sound-bars" },
          { name: "Home Theater", link: "/electronics/home-theater" },
        ],
      },
    ],
    brands: [
      {
        name: "Samsung",
        image: "https://via.placeholder.com/80x40?text=Samsung",
        link: "/brands/samsung",
      },
      {
        name: "Apple",
        image: "https://via.placeholder.com/80x40?text=Apple",
        link: "/brands/apple",
      },
      {
        name: "Sony",
        image: "https://via.placeholder.com/80x40?text=Sony",
        link: "/brands/sony",
      },
      {
        name: "LG",
        image: "https://via.placeholder.com/80x40?text=LG",
        link: "/brands/lg",
      },
      {
        name: "HP",
        image: "https://via.placeholder.com/80x40?text=HP",
        link: "/brands/hp",
      },
    ],
    promoImage:
      "https://images.pexels.com/photos/356056/pexels-photo-356056.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2",
    promoTitle: "TECH ESSENTIALS",
  },
];
