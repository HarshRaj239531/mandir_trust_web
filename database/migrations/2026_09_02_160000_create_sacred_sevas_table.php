<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sacred_sevas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tagline')->nullable();
            $table->text('impact_description')->nullable();
            $table->string('icon')->default('🕉️');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed initial Sacred Seva causes matching the screenshot
        DB::table('sacred_sevas')->insert([
            [
                'title' => 'Maha Annadanam',
                'tagline' => 'Sponsor daily free food for devotees.',
                'impact_description' => 'Feeds 5,000+ daily pilgrims with fresh, hot sattvic Mahaprasadam.',
                'icon' => '🍲',
                'sort_order' => 1,
                'is_default' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Surabhi Gau Seva',
                'tagline' => 'Fodder & healthcare for sacred indigenous cows.',
                'impact_description' => 'Provides green fodder, jaggery, and veterinary care to 500+ Gir cows.',
                'icon' => '🐄',
                'sort_order' => 2,
                'is_default' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Veda Vidyapeeth & Gurukula',
                'tagline' => 'Sponsor traditional Sanskrit Vedic schooling.',
                'impact_description' => 'Funds Sanskrit scriptures, boarding, and books for young Vedic students.',
                'icon' => '📜',
                'sort_order' => 3,
                'is_default' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Akhand Jyoti & Mandir Preservation',
                'tagline' => 'Pure cow ghee for perpetual lamp & stone care.',
                'impact_description' => 'Maintains temple Akhand Diya pure ghee supply and heritage sandstone upkeep.',
                'icon' => '🪔',
                'sort_order' => 4,
                'is_default' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed default Daan offering settings
        $defaultSettings = [
            ['key' => 'daan_step1_badge', 'value' => 'प्रथम चरण', 'type' => 'text', 'group' => 'pavitra_daan', 'label' => 'Step 1 Badge'],
            ['key' => 'daan_step1_title', 'value' => 'Choose Sacred Seva', 'type' => 'text', 'group' => 'pavitra_daan', 'label' => 'Step 1 Title'],
            ['key' => 'daan_step2_badge', 'value' => 'द्वितीय चरण', 'type' => 'text', 'group' => 'pavitra_daan', 'label' => 'Step 2 Badge'],
            ['key' => 'daan_step2_title', 'value' => 'Select Daan Offering', 'type' => 'text', 'group' => 'pavitra_daan', 'label' => 'Step 2 Title'],
            ['key' => 'daan_preset_amounts', 'value' => '501, 1100, 2100, 5100', 'type' => 'text', 'group' => 'pavitra_daan', 'label' => 'Preset Donation Amounts (₹)'],
            ['key' => 'daan_default_amount', 'value' => '1100', 'type' => 'text', 'group' => 'pavitra_daan', 'label' => 'Default Selected Amount (₹)'],
            ['key' => 'daan_custom_amount_label', 'value' => 'Or Enter Custom Amount (₹)', 'type' => 'text', 'group' => 'pavitra_daan', 'label' => 'Custom Amount Label'],
            ['key' => 'daan_80g_note', 'value' => '📜 80G Tax Exemption Certificate emailed immediately.', 'type' => 'text', 'group' => 'pavitra_daan', 'label' => '80G Tax Benefit Note'],
            ['key' => 'daan_security_note', 'value' => '🔒 100% Encrypted & Govt Compliant Charitable Account.', 'type' => 'text', 'group' => 'pavitra_daan', 'label' => 'Security & Trust Note'],
            ['key' => 'daan_button_text', 'value' => 'Proceed to Divine Offering & Save Receipt 💳', 'type' => 'text', 'group' => 'pavitra_daan', 'label' => 'Offering Submit Button Text'],
            ['key' => 'daan_upi_id', 'value' => 'shringirishi.trust@sbi', 'type' => 'text', 'group' => 'pavitra_daan', 'label' => 'Mandir Trust UPI ID'],
        ];

        foreach ($defaultSettings as $setting) {
            DB::table('site_settings')->updateOrInsert(
                ['key' => $setting['key']],
                array_merge($setting, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sacred_sevas');
        DB::table('site_settings')->where('group', 'pavitra_daan')->delete();
    }
};
