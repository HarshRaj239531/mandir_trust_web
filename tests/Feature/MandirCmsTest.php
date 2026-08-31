<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Pooja;
use App\Models\PoojaBooking;
use App\Models\TempleEvent;
use App\Models\User;
use Database\Seeders\MandirCmsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MandirCmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(MandirCmsSeeder::class);
    }

    public function test_public_pages_load_database_content(): void
    {
        $this->get('/')->assertStatus(200);
        $this->get('/poojas')->assertStatus(200);
        $this->get('/donate')->assertStatus(200);
        $this->get('/events')->assertStatus(200);
        $this->get('/facilities')->assertStatus(200);
        $this->get('/gallery')->assertStatus(200);
    }

    public function test_devotee_can_book_pooja_into_database(): void
    {
        $pooja = Pooja::first();

        $response = $this->post('/poojas/book', [
            'pooja_id' => $pooja->id,
            'pooja_name' => $pooja->title,
            'devotee_name' => 'Aditya Sharma',
            'gotra' => 'Kashyap',
            'nakshatra' => 'Rohini',
            'preferred_date' => '2026-09-15',
            'mobile_number' => '9876543210',
            'amount' => $pooja->dakshina,
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('pooja_bookings', [
            'devotee_name' => 'Aditya Sharma',
            'pooja_id' => $pooja->id,
            'gotra' => 'Kashyap',
        ]);
    }

    public function test_devotee_can_donate_and_generate_receipt_in_database(): void
    {
        $response = $this->post('/donate', [
            'donor_name' => 'Rameshwar Lal',
            'pan_number' => 'ABCDE1234F',
            'email' => 'rameshwar@gmail.com',
            'mobile_number' => '9876543211',
            'amount' => 5100,
            'seva_cause' => 'Maha Annadanam',
            'payment_mode' => 'UPI / Online QR',
        ]);

        $response->assertSessionHas('donation_success');
        $this->assertDatabaseHas('donations', [
            'donor_name' => 'Rameshwar Lal',
            'amount' => 5100,
            'seva_cause' => 'Maha Annadanam',
        ]);
    }

    public function test_admin_can_manage_cms(): void
    {
        $admin = User::factory()->create([
            'email' => 'mandiradmin@gmail.com',
            'is_admin' => true,
        ]);

        $this->actingAs($admin);

        // Admin pages
        $this->get('/mandiradmin/poojas')->assertStatus(200);
        $this->get('/mandiradmin/donations')->assertStatus(200);
        $this->get('/mandiradmin/events')->assertStatus(200);
        $this->get('/mandiradmin/facilities')->assertStatus(200);
        $this->get('/mandiradmin/gallery')->assertStatus(200);

        // Create a new Pooja in DB
        $postPooja = $this->post('/mandiradmin/poojas', [
            'title' => 'Special Chandi Path',
            'category' => 'शक्ति अनुष्ठान',
            'deity' => 'Maa Durga',
            'dakshina' => 5100,
            'duration' => '3 Hours',
            'timing' => '07:00 AM - 10:00 AM',
            'priest' => 'Acharya Vidyadhar Ji',
            'description' => 'Auspicious Durga Saptashati recitation with sacred ahutis.',
        ]);
        $postPooja->assertRedirect();
        $this->assertDatabaseHas('poojas', ['title' => 'Special Chandi Path']);

        // Create an Event in DB
        $postEvent = $this->post('/mandiradmin/events', [
            'title' => 'Sharad Navratri Utsav',
            'category' => 'Navratri Mahotsav',
            'event_date' => '15 Oct - 24 Oct 2026',
            'timings' => '05:00 AM - 10:00 PM',
            'expected_crowd' => '1,00,000+ Devotees',
            'coordinator' => 'Mahant Ji',
            'status' => 'Upcoming',
            'description' => 'Nine divine nights of Garbha and Akhand Deepam.',
        ]);
        $postEvent->assertRedirect();
        $this->assertDatabaseHas('temple_events', ['title' => 'Sharad Navratri Utsav']);

        // Test Edit / Update Gallery in DB
        $gallery = Gallery::first();
        $updateGallery = $this->put('/mandiradmin/gallery/' . $gallery->id, [
            'title' => 'Updated Divine Shringar Darshan',
            'category' => 'Sanctum Darshan',
            'caption' => 'Updated sacred deity ornaments and gold crown.',
        ]);
        $updateGallery->assertSessionHas('success');
        $this->assertDatabaseHas('galleries', [
            'id' => $gallery->id,
            'title' => 'Updated Divine Shringar Darshan',
            'caption' => 'Updated sacred deity ornaments and gold crown.',
        ]);

        // Test Dynamic Homepage Media Upload in Admin Settings
        \Illuminate\Support\Facades\Storage::fake('public');
        $fakeHeroImage = \Illuminate\Http\UploadedFile::fake()->image('custom_hero.jpg', 1920, 1080);
        $fakeDarshanImage = \Illuminate\Http\UploadedFile::fake()->image('custom_darshan.jpg', 1280, 720);

        $updateMedia = $this->post('/mandiradmin/settings/homepage-media', [
            'hero_mandir_image' => $fakeHeroImage,
            'live_darshan_image' => $fakeDarshanImage,
        ]);
        $updateMedia->assertSessionHas('success');
        $this->assertDatabaseHas('site_settings', [
            'key' => 'hero_mandir_image',
            'group' => 'homepage',
        ]);
        $this->assertDatabaseHas('site_settings', [
            'key' => 'live_darshan_image',
            'group' => 'homepage',
        ]);
    }
}
