<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\SacredSeva;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PavitraDaanManagementTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);

        $this->admin = User::create([
            'name' => 'Admin Head',
            'nickname' => 'HeadAdmin',
            'mother_name' => 'Maa',
            'gender' => 'male',
            'dob' => '1980-01-01',
            'email' => 'daanadmin@gmail.com',
            'mobile_number' => '9876543290',
            'pincode' => '110001',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
    }

    /**
     * 1. Admin can access the Pavitra Daan setup screen.
     */
    public function test_admin_can_view_pavitra_daan_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/mandiradmin/pavitra-daan');

        $response->assertStatus(200);
        $response->assertSee('Pavitra Daan Setup');
        $response->assertSee('Sacred Seva Causes');
        $response->assertSee('Select Daan Offering Settings');
    }

    /**
     * 2. Admin can create a new Sacred Seva.
     */
    public function test_admin_can_create_new_sacred_seva(): void
    {
        $response = $this->actingAs($this->admin)->post('/mandiradmin/pavitra-daan/sevas', [
            'title' => 'Shiva Jalabhishek Seva',
            'tagline' => 'Sacred holy Ganga jal offering for Shivalinga.',
            'impact_description' => 'Sponsors 108 liters of Gangajal and pure bilva patra daily.',
            'icon' => '🔱',
            'sort_order' => 5,
            'is_active' => 1,
            'is_default' => 0,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('sacred_sevas', [
            'title' => 'Shiva Jalabhishek Seva',
            'tagline' => 'Sacred holy Ganga jal offering for Shivalinga.',
            'icon' => '🔱',
        ]);
    }

    /**
     * 3. Admin can update an existing Sacred Seva.
     */
    public function test_admin_can_update_sacred_seva(): void
    {
        $seva = SacredSeva::first();

        $response = $this->actingAs($this->admin)->put("/mandiradmin/pavitra-daan/sevas/{$seva->id}", [
            'title' => 'Maha Annadanam Bhandara',
            'tagline' => 'Free hot meals served continuously to pilgrims.',
            'impact_description' => 'Feeds 10,000+ daily devotees with sacred prasad.',
            'icon' => '🍲',
            'sort_order' => 1,
            'is_active' => 1,
            'is_default' => 1,
        ]);

        $response->assertRedirect();
        $seva->refresh();
        $this->assertEquals('Maha Annadanam Bhandara', $seva->title);
        $this->assertEquals('Feeds 10,000+ daily devotees with sacred prasad.', $seva->impact_description);
    }

    /**
     * 4. Admin can toggle active status of a Sacred Seva.
     */
    public function test_admin_can_toggle_seva_active_status(): void
    {
        $seva = SacredSeva::first();
        $initialStatus = $seva->is_active;

        $response = $this->actingAs($this->admin)->post("/mandiradmin/pavitra-daan/sevas/{$seva->id}/toggle-status");

        $response->assertRedirect();
        $seva->refresh();
        $this->assertEquals(!$initialStatus, $seva->is_active);
    }

    /**
     * 5. Admin can update Daan offering settings (preset amounts, headings, badges).
     */
    public function test_admin_can_update_daan_settings(): void
    {
        $response = $this->actingAs($this->admin)->post('/mandiradmin/pavitra-daan/settings', [
            'daan_step1_badge' => 'चरण १ (प्रणाम)',
            'daan_step1_title' => 'Choose Sacred Temple Seva',
            'daan_step2_badge' => 'चरण २ (समर्पण)',
            'daan_step2_title' => 'Select Divine Daan Amount',
            'daan_preset_amounts' => '251, 501, 1100, 2500, 5100',
            'daan_default_amount' => 501,
            'daan_custom_amount_label' => 'Enter Desired Offering Amount (₹)',
            'daan_80g_note' => '📜 Instant 80G Tax Exemption Certificate.',
            'daan_security_note' => '🔒 100% Safe & Secure Mandir Trust Portal.',
            'daan_button_text' => 'Offer Sacred Daan Now 💳',
            'daan_upi_id' => 'trust@upi',
        ]);

        $response->assertRedirect();
        $this->assertEquals('251, 501, 1100, 2500, 5100', SiteSetting::get('daan_preset_amounts'));
        $this->assertEquals('501', SiteSetting::get('daan_default_amount'));
        $this->assertEquals('Offer Sacred Daan Now 💳', SiteSetting::get('daan_button_text'));
    }

    /**
     * 6. Public /donate page reflects all dynamic sevas and settings.
     */
    public function test_public_donate_page_renders_dynamic_sevas_and_settings(): void
    {
        $response = $this->get('/donate');

        $response->assertStatus(200);
        $response->assertSee('Maha Annadanam');
        $response->assertSee('Surabhi Gau Seva');
        $response->assertSee('₹ 1,100');
        $response->assertSee('80G Tax Exemption Certificate');
    }

    /**
     * 7. Devotee can submit donation and record is saved with dynamic seva cause.
     */
    public function test_devotee_can_submit_donation(): void
    {
        $response = $this->post('/donate', [
            'donor_name' => 'Vikramaditya Sharma',
            'pan_number' => 'ABCDE1234F',
            'email' => 'vikram@gmail.com',
            'mobile_number' => '9876543201',
            'seva_cause' => 'Surabhi Gau Seva',
            'amount' => 2100,
            'payment_mode' => 'UPI / Online QR',
        ]);

        $response->assertSessionHas('donation_success');
        $this->assertDatabaseHas('donations', [
            'donor_name' => 'Vikramaditya Sharma',
            'seva_cause' => 'Surabhi Gau Seva',
            'amount' => 2100,
        ]);
    }
}
