<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Pooja;
use App\Models\PoojaBooking;
use App\Models\TempleEvent;
use Illuminate\Database\Seeder;

class MandirCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Poojas
        $poojas = [
            [
                'title' => 'Maha Rudrabhishek (Panchamrit & Rudram)',
                'slug' => 'maha-rudrabhishek',
                'deity' => 'Lord Shiva',
                'category' => 'शैव पूजा विधान',
                'dakshina' => 2100.00,
                'duration' => '1.5 Hours',
                'timing' => 'Daily 07:00 AM & 05:00 PM',
                'priest' => 'Pt. Vidyadhar Shastri',
                'description' => 'Ceremonial sacred bath of the Shiva Lingam using 11 auspicious ingredients with continuous chanting of Namakam & Chamakam Vedic hymns. Removes planetary doshas and invokes inner peace.',
                'inclusions' => 'Includes pure samagri, 3 acharyas, individual Gotra Sankalpa, consecrated Silver Coin & Vibhuti delivery.',
                'image' => 'images/rudrabhishek.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Shri Satyanarayan Maha Vrat Katha',
                'slug' => 'satyanarayan-katha',
                'deity' => 'Lord Vishnu',
                'category' => 'वैष्णव पूजा विधान',
                'dakshina' => 1500.00,
                'duration' => '2.0 Hours',
                'timing' => 'Every Purnima & Auspicious Tithis',
                'priest' => 'Pt. Ramanuj Ji',
                'description' => 'Veneration of Lord Vishnu for domestic harmony, business growth, and family well-being. Recitation of 5-chapter Skanda Purana katha on Purnima.',
                'inclusions' => 'Full Panchamrit & Desi Ghee Sheera Prasad, live video stream link for remote family.',
                'image' => 'images/satyanarayan.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Maa Durga Chandi Path & Havan',
                'slug' => 'chandi-path-havan',
                'deity' => 'Maa Durga',
                'category' => 'शाक्त पूजा विधान',
                'dakshina' => 3500.00,
                'duration' => '3.0 Hours',
                'timing' => 'Tuesdays, Fridays & Navratri',
                'priest' => 'Acharya Hemant Shukla',
                'description' => 'Powerful 700-shloka Devi Mahatmyam recitation accompanied by sacred Ahuti havan for supreme protection and overcoming obstacles.',
                'inclusions' => 'Chandi Yantra, sacred Kumkum, energized Raksha Sutra sent to home.',
                'image' => 'images/chandi.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Navagraha Shanti & Planetary Havan',
                'slug' => 'navagraha-shanti',
                'deity' => 'Navgrah Devatas',
                'category' => 'वैदिक शांति विधान',
                'dakshina' => 2500.00,
                'duration' => '2.5 Hours',
                'timing' => 'Daily 09:00 AM',
                'priest' => 'Pt. Shambhu Nath Joshi',
                'description' => 'Pacifies malefic influences of Rahu, Ketu, Shani and aligns celestial harmony through specialized samidhas and Vedic beeja mantras.',
                'inclusions' => '9-gem Navratna prasad packet, certified temple blessing certificate.',
                'image' => 'images/navgraha.jpg',
                'is_active' => true,
            ],
            [
                'title' => 'Sankat Mochan Hanuman Path & Sindoor Seva',
                'slug' => 'hanuman-path',
                'deity' => 'Lord Hanuman',
                'category' => 'संकट मोचन विधान',
                'dakshina' => 1100.00,
                'duration' => '1.0 Hour',
                'timing' => 'Every Tuesday & Saturday Evening',
                'priest' => 'Pt. Vidyadhar Shastri',
                'description' => '108 recitations of Hanuman Chalisa along with divine Jasmine oil & sacred Chola Sindoor offering at the sacred feet of Lord Hanuman.',
                'inclusions' => 'Besan Laddu Bhog, sacred Sindoor Tilak blessed from deity.',
                'image' => 'images/hanuman.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($poojas as $p) {
            Pooja::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 2. Seed Pooja Bookings (only if table is empty)
        if (PoojaBooking::count() === 0) {
            $rudra = Pooja::where('slug', 'maha-rudrabhishek')->first();
            $satya = Pooja::where('slug', 'satyanarayan-katha')->first();

            PoojaBooking::create([
                'pooja_id' => $rudra ? $rudra->id : null,
                'pooja_name' => 'Maha Rudrabhishek (Panchamrit & Rudram)',
                'devotee_name' => 'Ramesh Chandra Sharma',
                'gotra' => 'Kashyap',
                'nakshatra' => 'Rohini',
                'preferred_date' => now()->addDays(3),
                'mobile_number' => '9812345678',
                'email' => 'ramesh.bhakt@gmail.com',
                'amount' => 2100.00,
                'status' => 'confirmed',
            ]);

            PoojaBooking::create([
                'pooja_id' => $satya ? $satya->id : null,
                'pooja_name' => 'Shri Satyanarayan Maha Vrat Katha',
                'devotee_name' => 'Sunita Kumari Verma',
                'gotra' => 'Bharadwaj',
                'nakshatra' => 'Pushya',
                'preferred_date' => now()->addDays(7),
                'mobile_number' => '9876501234',
                'email' => 'sunita.verma@gmail.com',
                'amount' => 1500.00,
                'status' => 'confirmed',
            ]);
        }

        // 3. Seed Donations
        $donations = [
            [
                'receipt_number' => 'DON-2026-001',
                'donor_name' => 'Ramesh Chandra Sharma',
                'pan_number' => 'ABCDE1234F',
                'email' => 'ramesh.bhakt@gmail.com',
                'mobile_number' => '9812345678',
                'seva_cause' => 'Maha Annadanam',
                'amount' => 5100.00,
                'payment_mode' => 'UPI',
                'payment_status' => 'verified',
                'notes' => 'On the occasion of family anniversary.',
            ],
            [
                'receipt_number' => 'DON-2026-002',
                'donor_name' => 'Sunita Kumari Verma',
                'pan_number' => 'PQRSK5678L',
                'email' => 'sunita.verma@gmail.com',
                'mobile_number' => '9876501234',
                'seva_cause' => 'Surabhi Gau Seva',
                'amount' => 2500.00,
                'payment_mode' => 'Net Banking',
                'payment_status' => 'verified',
                'notes' => 'Fodder for 25 cows.',
            ],
            [
                'receipt_number' => 'DON-2026-003',
                'donor_name' => 'Anand Kumar Agarwal',
                'pan_number' => 'ZXCVB9876M',
                'email' => 'anand.agarwal@gmail.com',
                'mobile_number' => '9822334455',
                'seva_cause' => 'Akhand Jyoti & Mandir Preservation',
                'amount' => 21000.00,
                'payment_mode' => 'Card',
                'payment_status' => 'verified',
                'notes' => 'Mandir Shikhar Gold leaf contribution.',
            ],
            [
                'receipt_number' => 'DON-2026-004',
                'donor_name' => 'Kavita Joshi',
                'pan_number' => 'LMNOP4321R',
                'email' => 'kavita.j@outlook.com',
                'mobile_number' => '9833445566',
                'seva_cause' => 'Veda Vidyapeeth & Gurukula',
                'amount' => 11000.00,
                'payment_mode' => 'Cheque',
                'payment_status' => 'verified',
                'notes' => 'Batuk education fund.',
            ],
        ];

        foreach ($donations as $d) {
            Donation::updateOrCreate(['receipt_number' => $d['receipt_number']], $d);
        }

        // 4. Seed Temple Events
        $events = [
            [
                'title' => 'Maha Shivaratri Akhand Mahotsav 2026',
                'slug' => 'maha-shivaratri-2026',
                'category' => 'Grand Mahotsav',
                'event_date' => '15 Feb - 17 Feb 2026',
                'timings' => 'All Night 4-Prahar Vigil',
                'expected_crowd' => '75,000+ Devotees',
                'coordinator' => 'Mandir Trust Committee & Sevashram',
                'description' => 'The supreme night of Lord Shiva. Continuous 4-Prahar Abhishekam with milk, bilva leaves, sugarcane juice, and holy bhasma with 108 priests.',
                'image' => 'https://images.unsplash.com/photo-1545128485-c400e7702796?auto=format&fit=crop&w=800&q=80',
                'status' => 'Upcoming',
            ],
            [
                'title' => 'Shri Krishna Janmashtami Celebration',
                'slug' => 'janmashtami-2026',
                'category' => 'Temple Utsav',
                'event_date' => '04 September 2026',
                'timings' => 'Midnight 12:00 AM Maha Abhishekam',
                'expected_crowd' => '50,000+ Devotees',
                'coordinator' => 'Pt. Vidyadhar Shukla & Bhajan Mandal',
                'description' => 'Grand celebration of Lord Krishna avatar. Jhulanotsav, Dahi Handi, 56-Bhog Mahaprasadam offering, and continuous Harinaam Sankirtan.',
                'image' => 'https://images.unsplash.com/photo-1609766857041-ed402ea8069a?auto=format&fit=crop&w=800&q=80',
                'status' => 'Scheduled',
            ],
            [
                'title' => 'Sharad Navratri Chandi Mahayajna',
                'slug' => 'sharad-navratri-2026',
                'category' => 'Navratri Mahotsav',
                'event_date' => '12 Oct - 21 Oct 2026',
                'timings' => 'Daily 08:00 AM - 08:00 PM',
                'expected_crowd' => '60,000+ Devotees',
                'coordinator' => 'Trust Board & Acharya Parishad',
                'description' => '9 sacred nights of divine mother veneration. Akhand Jyoti, Kumari Poojan, and daily Chandi Havan with thousand lotus offerings.',
                'image' => 'https://images.unsplash.com/photo-1582510003544-4d00b7f74220?auto=format&fit=crop&w=800&q=80',
                'status' => 'Scheduled',
            ],
        ];

        foreach ($events as $ev) {
            TempleEvent::updateOrCreate(['slug' => $ev['slug']], $ev);
        }

        // 5. Seed Facilities
        $facilities = [
            [
                'name' => 'Shri Shivkrupa Dharmashala & Guest House',
                'type' => 'Devotee Stay & AC/Non-AC Rooms',
                'capacity' => '60 Rooms (Family & Dormitory)',
                'occupancy' => '48 Rooms Occupied (80%)',
                'incharge' => 'Shri Balmukund Ji (Dharmashala Manager)',
                'description' => 'Spacious, clean, and peaceful accommodation for traveling pilgrims with 24/7 hot water, power backup, and temple elevator access.',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80',
                'status' => 'Operational',
            ],
            [
                'name' => 'Maa Annapurna Annakshetra (Dining Hall)',
                'type' => 'Free Pure Sattvic Mahaprasadam',
                'capacity' => '5,000+ Devotees Daily',
                'occupancy' => '100% Active (11:30 AM - 3:30 PM, 7:00 PM - 10:00 PM)',
                'incharge' => 'Smt. Geeta Devi & Seva Dal',
                'description' => 'Unlimited free piping-hot sattvic meals cooked in pure desi ghee and offered first to the presiding deity before serving all pilgrims unconditionally.',
                'image' => 'https://images.unsplash.com/photo-1514894780887-121968d00567?auto=format&fit=crop&w=800&q=80',
                'status' => 'Operational',
            ],
            [
                'name' => 'Surabhi Kamdhenu Gaushala',
                'type' => 'Sacred Indigenous Cow Sanctuary',
                'capacity' => '150 Indigenous Gir & Sahiwal Cows',
                'occupancy' => '125 Sacred Cows & Calves',
                'incharge' => 'Gopal Bhakt Ramlal Sharma',
                'description' => 'Protects indigenous cows, providing organic fodder, Ayurvedic medical attention, and producing pure ghee and milk for temple abhishekam.',
                'image' => 'https://images.unsplash.com/photo-1570042225831-d98fa7577f1e?auto=format&fit=crop&w=800&q=80',
                'status' => 'Operational',
            ],
            [
                'name' => 'Shri Shankar Veda Gurukulam & Vidyapeeth',
                'type' => 'Traditional Vedic Schooling',
                'capacity' => '50 Residential Batuk Students',
                'occupancy' => '45 Residential Batuks enrolled',
                'incharge' => 'Acharya Hemant Shukla (Kulapati)',
                'description' => 'Free residential education in Shukla Yajurveda, Krishna Yajurveda, Sanskrit grammar, and temple rituals preserving Sanatan knowledge.',
                'image' => 'https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=800&q=80',
                'status' => 'Operational',
            ],
        ];

        foreach ($facilities as $fac) {
            Facility::updateOrCreate(['name' => $fac['name']], $fac);
        }

        // 6. Seed Galleries
        $galleries = [
            [
                'title' => 'Shri Garbhagriha Alankara & Shiva Linga Darshan',
                'category' => 'Sanctum Darshan',
                'image_path' => 'images/hero-mandir.jpg',
                'caption' => 'Morning Shringar darshan of the consecrated Shiva Lingam with bilva leaves and fresh lotus.',
                'is_published' => true,
            ],
            [
                'title' => 'Twilight Sandhya Maha Aarti with 108 Deepams',
                'category' => 'Daily Aartis',
                'image_path' => 'images/mandir-aarti.jpg',
                'caption' => 'Priests performing the evening grand aarti with burning camphor and brass multi-tiered lamps.',
                'is_published' => true,
            ],
            [
                'title' => 'Ancient Sandstone Shikhara & Heritage Mandapam',
                'category' => 'Heritage',
                'image_path' => 'images/mandir-aarti.jpg',
                'caption' => 'Intricately hand-carved pillars depicting cosmic churning and celestial dancers.',
                'is_published' => true,
            ],
            [
                'title' => 'Maa Annapurna Free Bhandara Service to Pilgrims',
                'category' => 'Festivals',
                'image_path' => 'images/mandir-goshala.jpg',
                'caption' => 'Devotees receiving holy Mahaprasadam in the temple dining complex.',
                'is_published' => true,
            ],
        ];

        foreach ($galleries as $gal) {
            Gallery::updateOrCreate(['title' => $gal['title']], $gal);
        }

        // 7. Seed Default Homepage Media Settings
        $siteSettings = [
            [
                'key' => 'hero_mandir_image',
                'value' => 'images/hero-mandir.jpg',
                'type' => 'image',
                'group' => 'homepage',
                'label' => 'Home Hero Background Sanctuary Photo',
                'description' => 'Main high-definition temple sanctum photo visible in the Hero section at the top of the Home Page.',
            ],
            [
                'key' => 'about_history_image',
                'value' => 'images/mandir-aarti.jpg',
                'type' => 'image',
                'group' => 'homepage',
                'label' => 'Home History & Heritage Photo',
                'description' => 'Parchment scroll photo shown in Chapter 1: Sacred Heritage & History section.',
            ],
            [
                'key' => 'live_darshan_image',
                'value' => 'images/mandir-aarti.jpg',
                'type' => 'image',
                'group' => 'homepage',
                'label' => 'Home Akhand Live Darshan Stream Photo',
                'description' => 'Preview broadcast window photo displayed in Chapter 3: 24/7 Garbhagriha Live Darshan.',
            ],
            [
                'key' => 'goshala_seva_image',
                'value' => 'images/mandir-goshala.jpg',
                'type' => 'image',
                'group' => 'homepage',
                'label' => 'Home Surabhi Goshala Seva Photo',
                'description' => 'Sacred indigenous Gir cows photo shown in Chapter 4: Surabhi Goshala Seva.',
            ],
        ];

        foreach ($siteSettings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
