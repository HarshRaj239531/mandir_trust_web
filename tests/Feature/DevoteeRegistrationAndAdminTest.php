<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DevoteeRegistrationAndAdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 1. Registration screen can be rendered with all 10 fields.
     */
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('भक्त');
        $response->assertSee('Full Name');
        $response->assertSee('Nick Name');
        $response->assertSee("Mother's Name", false);
        $response->assertSee('Gender');
        $response->assertSee('D.O.B');
        $response->assertSee('Gmail / Email');
        $response->assertSee('Mobile Number');
        $response->assertSee('WhatsApp Number');
        $response->assertSee('Pincode');
        $response->assertSee('Profile Picture');
        $response->assertSee('स्पॉन्सर सत्यापन');
    }

    /**
     * 2. New Devotee can register with all 10 fields and valid Sponsor ID and is redirected to /my-account.
     */
    public function test_new_devotee_can_register_with_all_10_fields(): void
    {
        $this->withoutMiddleware();
        Storage::fake('public');

        $sponsor = User::create([
            'member_id' => 'DS101010101010',
            'name' => 'DS SWAMI JEE',
            'nickname' => 'DS SWAMI JEE',
            'mother_name' => 'Maa Jagadamba',
            'gender' => 'other',
            'dob' => '1975-01-01',
            'email' => 'dsswamijee1@mandirtrust.org',
            'mobile_number' => '9900101010',
            'whatsapp_number' => '9900101010',
            'pincode' => '824231',
            'password' => Hash::make('Swami@12345'),
            'is_admin' => false,
            'status' => 'active',
        ]);

        $file = UploadedFile::fake()->image('selfie.jpg');

        $response = $this->post('/register', [
            'sponsor_member_id' => 'DS101010101010',
            'name' => 'Aarav Nath Sharma',
            'nickname' => 'MahadevBhakt_Aarav',
            'mother_name' => 'Smt. Pushpa Devi',
            'gender' => 'male',
            'dob' => '1998-05-10',
            'email' => 'aarav.bhakt@gmail.com',
            'mobile_number' => '9876543211',
            'whatsapp_number' => '9876543211',
            'pincode' => '201001',
            'profile_photo' => $file,
            'password' => 'Password@123',
            'password_confirmation' => 'Password@123',
        ]);

        $response->assertRedirect('/my-account');
        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'sponsor_id' => $sponsor->id,
            'name' => 'Aarav Nath Sharma',
            'nickname' => 'MahadevBhakt_Aarav',
            'mother_name' => 'Smt. Pushpa Devi',
            'gender' => 'male',
            'email' => 'aarav.bhakt@gmail.com',
            'mobile_number' => '9876543211',
            'whatsapp_number' => '9876543211',
            'pincode' => '201001',
            'is_admin' => false,
        ]);

        $createdUser = User::where('email', 'aarav.bhakt@gmail.com')->first();
        $this->assertNotNull($createdUser->member_id);
        $this->assertStringStartsWith('DS', $createdUser->member_id);
        $this->assertEquals(14, strlen($createdUser->member_id)); // DS + 12 digits = 14 chars
    }

    /**
     * 2b. New Devotee registers with Base64 compressed photo and photo is visible in admin.
     */
    public function test_new_devotee_can_register_with_base64_compressed_photo_and_visible_in_admin(): void
    {
        $this->withoutMiddleware();

        $sponsor = User::create([
            'member_id' => 'DS100100100100',
            'name' => 'DS SWAMI JEE',
            'nickname' => 'DS SWAMI JEE',
            'mother_name' => 'Maa Jagadamba',
            'gender' => 'other',
            'dob' => '1975-01-01',
            'email' => 'dsswamijee2@mandirtrust.org',
            'mobile_number' => '9900100100',
            'whatsapp_number' => '9900100100',
            'pincode' => '824231',
            'password' => Hash::make('Swami@12345'),
            'is_admin' => false,
            'status' => 'active',
        ]);

        $im = imagecreatetruecolor(60, 60);
        $color = imagecolorallocate($im, 145, 32, 3);
        imagefill($im, 0, 0, $color);
        ob_start();
        imagejpeg($im);
        $base64 = 'data:image/jpeg;base64,' . base64_encode(ob_get_clean());
        imagedestroy($im);

        $response = $this->post('/register', [
            'sponsor_member_id' => 'DS100100100100',
            'name' => 'Bhanu Pratap Singh',
            'nickname' => 'BhanuBhakt',
            'mother_name' => 'Smt. Sarita Devi',
            'gender' => 'male',
            'dob' => '1995-04-12',
            'email' => 'bhanu.bhakt@gmail.com',
            'mobile_number' => '9876543233',
            'whatsapp_number' => '9876543233',
            'pincode' => '800001',
            'profile_photo_base64' => $base64,
            'password' => 'Password@123',
            'password_confirmation' => 'Password@123',
        ]);

        $response->assertRedirect('/my-account');

        $devotee = User::where('email', 'bhanu.bhakt@gmail.com')->first();
        $this->assertNotNull($devotee);
        $this->assertNotNull($devotee->profile_photo);
        $this->assertStringStartsWith('devotees/', $devotee->profile_photo);
        $this->assertStringStartsWith('DS', $devotee->member_id);

        // Admin checks devotees table
        $admin = User::create([
            'name' => 'Admin Head',
            'nickname' => 'Admin',
            'mother_name' => 'Maa',
            'gender' => 'male',
            'dob' => '1980-01-01',
            'email' => 'superadmin@gmail.com',
            'mobile_number' => '9999999999',
            'pincode' => '110001',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'is_admin' => true,
        ]);

        $adminResponse = $this->actingAs($admin)->get('/mandiradmin/devotees');
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee($devotee->nickname);
        $adminResponse->assertSee($devotee->profile_photo_url);

        // Cleanup
        \App\Helpers\ImageHelper::delete($devotee->profile_photo);
    }

    /**
     * 3. Devotee /my-account page shows locked field notices and public preview card.
     */
    public function test_devotee_profile_shows_locked_fields_and_mobile_preview(): void
    {
        $user = User::create([
            'name' => 'Aarav Nath Sharma',
            'nickname' => 'MahadevBhakt_Aarav',
            'mother_name' => 'Smt. Pushpa Devi',
            'gender' => 'male',
            'dob' => '1998-05-10',
            'email' => 'aarav.bhakt@gmail.com',
            'mobile_number' => '9876543211',
            'whatsapp_number' => '9876543211',
            'pincode' => '201001',
            'password' => Hash::make('Password@123'),
        ]);

        $response = $this->actingAs($user)->get('/my-account');

        $response->assertStatus(200);
        $response->assertSee('MahadevBhakt_Aarav');
        $response->assertSee('Aarav Nath Sharma');
        $response->assertSee('Pushpa Devi');
        $response->assertSee('Sanctum Locked Records');
        $response->assertSee('Admin Editable Only');
        $response->assertSee('Mobile Public View');
    }

    /**
     * 4. Devotee CANNOT modify locked fields (1, 3, 4, 5, 6) from devotee profile update form.
     */
    public function test_devotee_cannot_modify_locked_fields_via_profile_update(): void
    {
        $user = User::create([
            'name' => 'Aarav Nath Sharma',
            'nickname' => 'MahadevBhakt_Aarav',
            'mother_name' => 'Smt. Pushpa Devi',
            'gender' => 'male',
            'dob' => '1998-05-10',
            'email' => 'aarav.bhakt@gmail.com',
            'mobile_number' => '9876543211',
            'whatsapp_number' => '9876543211',
            'pincode' => '201001',
            'password' => Hash::make('Password@123'),
        ]);

        // Attempt to pass changed locked fields (name, mother_name, email)
        $response = $this->actingAs($user)->post('/my-account', [
            'name' => 'HACKED NAME',
            'mother_name' => 'HACKED MOTHER',
            'email' => 'hacked@gmail.com',
            'nickname' => 'UpdatedBhakt_Aarav',
            'mobile_number' => '9876500000',
            'whatsapp_number' => '9876500000',
            'pincode' => '110002',
        ]);

        $response->assertRedirect('/my-account');

        // Check that allowed fields updated (Nick Name only)
        $user->refresh();
        $this->assertEquals('UpdatedBhakt_Aarav', $user->nickname);

        // Check that locked fields were NOT changed (Name, Mother, Email, Mobile, Pincode)
        $this->assertEquals('9876543211', $user->mobile_number);
        $this->assertEquals('201001', $user->pincode);
        $this->assertEquals('Aarav Nath Sharma', $user->name);
        $this->assertEquals('Smt. Pushpa Devi', $user->mother_name);
        $this->assertEquals('aarav.bhakt@gmail.com', $user->email);
    }

    /**
     * 4b. Sponsor verification endpoint returns sponsor details.
     */
    public function test_verify_sponsor_endpoint(): void
    {
        $sponsor = User::create([
            'member_id' => 'DS101010101010',
            'name' => 'DS SWAMI JEE',
            'nickname' => 'DS SWAMI JEE',
            'mother_name' => 'Maa Jagadamba',
            'gender' => 'other',
            'dob' => '1975-01-01',
            'email' => 'dsswamijee1@mandirtrust.org',
            'mobile_number' => '9900101010',
            'whatsapp_number' => '9900101010',
            'pincode' => '824231',
            'password' => Hash::make('Swami@12345'),
            'is_admin' => false,
            'status' => 'active',
        ]);

        $response = $this->getJson('/verify-sponsor?sponsor_id=DS101010101010');
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'sponsor' => [
                'name' => 'DS SWAMI JEE',
                'member_id' => 'DS101010101010',
            ],
        ]);
    }

    /**
     * 5. Visiting /mandiradmin renders the Admin Login page.
     */
    public function test_mandiradmin_url_opens_admin_login_page(): void
    {
        $response = $this->get('/mandiradmin');

        $response->assertStatus(200);
        $response->assertSee('प्रशासनिक संकुल');
        $response->assertSee('Mandir Trust Admin Portal');
        $response->assertSee('mandiradmin@gmail.com');
    }

    /**
     * 6. Normal devotee cannot access /mandiradmin/dashboard.
     */
    public function test_non_admin_cannot_access_mandiradmin_dashboard(): void
    {
        $user = User::create([
            'name' => 'Regular Devotee',
            'nickname' => 'RegularBhakt',
            'mother_name' => 'Mother Name',
            'gender' => 'male',
            'dob' => '1995-01-01',
            'email' => 'regular@gmail.com',
            'mobile_number' => '9876543200',
            'pincode' => '110001',
            'password' => Hash::make('Password@123'),
            'is_admin' => false,
        ]);

        $response = $this->actingAs($user)->get('/mandiradmin/dashboard');

        // Should be redirected with unauthorized error
        $response->assertRedirect('/my-account');
    }

    /**
     * 7. Mandir Admin can login and view devotees on /mandiradmin/dashboard.
     */
    public function test_admin_can_login_and_view_devotees_table(): void
    {
        $admin = User::create([
            'name' => 'Mandir Admin Head',
            'nickname' => 'Sanctum Admin',
            'mother_name' => 'Maa',
            'gender' => 'other',
            'dob' => '1980-01-01',
            'email' => 'mandiradmin@gmail.com',
            'mobile_number' => '9876543210',
            'pincode' => '110001',
            'password' => Hash::make('Admin@12345'),
            'is_admin' => true,
        ]);

        $devotee = User::create([
            'name' => 'Aarav Nath Sharma',
            'nickname' => 'MahadevBhakt_Aarav',
            'mother_name' => 'Smt. Pushpa Devi',
            'gender' => 'male',
            'dob' => '1998-05-10',
            'email' => 'aarav.bhakt@gmail.com',
            'mobile_number' => '9876543211',
            'pincode' => '201001',
            'password' => Hash::make('Password@123'),
            'is_admin' => false,
        ]);

        // Login as admin
        $loginResponse = $this->post('/mandiradmin/login', [
            'email' => 'mandiradmin@gmail.com',
            'password' => 'Admin@12345',
        ]);

        $loginResponse->assertRedirect('/mandiradmin/dashboard');
        $this->assertAuthenticatedAs($admin);

        // View dashboard
        $dashboardResponse = $this->get('/mandiradmin/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Aarav Nath Sharma');
        $dashboardResponse->assertSee('MahadevBhakt_Aarav');
        $dashboardResponse->assertSee('201001');

        // View registered devotees page
        $devoteesResponse = $this->get('/mandiradmin/devotees');
        $devoteesResponse->assertStatus(200);
        $devoteesResponse->assertSee('Aarav Nath Sharma');
        $devoteesResponse->assertSee('MahadevBhakt_Aarav');
        $devoteesResponse->assertSee('Pushpa Devi');
        $devoteesResponse->assertSee('201001');
    }

    /**
     * 8. Admin CAN edit all 10 devotee fields including the locked ones (1, 3, 4, 5, 6).
     */
    public function test_admin_can_edit_all_devotee_fields_including_locked_fields(): void
    {
        $admin = User::create([
            'name' => 'Mandir Admin Head',
            'nickname' => 'Sanctum Admin',
            'mother_name' => 'Maa',
            'gender' => 'other',
            'dob' => '1980-01-01',
            'email' => 'mandiradmin@gmail.com',
            'mobile_number' => '9876543210',
            'pincode' => '110001',
            'password' => Hash::make('Admin@12345'),
            'is_admin' => true,
        ]);

        $devotee = User::create([
            'name' => 'Aarav Nath Sharma',
            'nickname' => 'MahadevBhakt_Aarav',
            'mother_name' => 'Smt. Pushpa Devi',
            'gender' => 'male',
            'dob' => '1998-05-10',
            'email' => 'aarav.bhakt@gmail.com',
            'mobile_number' => '9876543211',
            'whatsapp_number' => '9876543211',
            'pincode' => '201001',
            'password' => Hash::make('Password@123'),
            'is_admin' => false,
            'status' => 'active',
        ]);

        // Admin updates devotee including Real Name (1), Mother's Name (3), Gender (4), DOB (5), Gmail (6)
        $response = $this->actingAs($admin)->put("/mandiradmin/devotees/{$devotee->id}", [
            'name' => 'Aarav Nath Sharma Maharaj',
            'nickname' => 'DivyaBhakt_Aarav',
            'mother_name' => 'Smt. Pushpavati Devi',
            'gender' => 'male',
            'dob' => '1998-05-12',
            'email' => 'aarav.maharaj@gmail.com',
            'mobile_number' => '9876543299',
            'whatsapp_number' => '9876543299',
            'pincode' => '201002',
            'status' => 'active',
        ]);

        $response->assertRedirect('/mandiradmin/devotees');

        // Check that ALL fields were successfully modified by Admin
        $devotee->refresh();
        $this->assertEquals('Aarav Nath Sharma Maharaj', $devotee->name);
        $this->assertEquals('DivyaBhakt_Aarav', $devotee->nickname);
        $this->assertEquals('Smt. Pushpavati Devi', $devotee->mother_name);
        $this->assertEquals('aarav.maharaj@gmail.com', $devotee->email);
        $this->assertEquals('1998-05-12', $devotee->dob->format('Y-m-d'));
        $this->assertEquals('9876543299', $devotee->mobile_number);
        $this->assertEquals('201002', $devotee->pincode);
    }
}
