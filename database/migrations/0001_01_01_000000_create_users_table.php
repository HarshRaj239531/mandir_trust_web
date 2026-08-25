<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Real Name (Private, Admin editable)
            $table->string('nickname'); // Nick Name (Publicly visible to other mobiles, Devotee editable)
            $table->string('mother_name'); // Mother's Name (Admin editable only)
            $table->string('gender'); // Gender: Male, Female, Other (Admin editable only)
            $table->date('dob'); // Date of Birth (Admin editable only)
            $table->string('email')->unique(); // Gmail/Email (Admin editable only)
            $table->string('mobile_number'); // Mobile Number (Devotee & Admin editable)
            $table->string('whatsapp_number')->nullable(); // WhatsApp Number (Devotee & Admin editable)
            $table->string('pincode', 10); // Pincode (Devotee & Admin editable)
            $table->string('profile_photo')->nullable(); // Selfie / File Picture (Devotee updatable anytime)
            $table->string('password'); // Password
            $table->boolean('is_admin')->default(false); // Admin flag
            $table->string('status')->default('active'); // Account status: active / inactive
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
