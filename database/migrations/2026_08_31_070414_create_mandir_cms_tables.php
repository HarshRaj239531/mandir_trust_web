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
        // 1. Poojas & Sevas Table
        Schema::create('poojas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('deity');
            $table->string('category')->default('शैव पूजा विधान');
            $table->decimal('dakshina', 10, 2);
            $table->string('duration')->default('1.5 Hours');
            $table->string('timing')->default('Daily 07:00 AM');
            $table->string('priest')->default('Pt. Vidyadhar Shastri');
            $table->text('description')->nullable();
            $table->text('inclusions')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Pooja Bookings Table
        Schema::create('pooja_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pooja_id')->nullable()->constrained('poojas')->nullOnDelete();
            $table->string('pooja_name');
            $table->string('devotee_name');
            $table->string('gotra')->nullable();
            $table->string('nakshatra')->nullable();
            $table->date('preferred_date');
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('status')->default('confirmed'); // pending, confirmed, completed, cancelled
            $table->timestamps();
        });

        // 3. Donations / Daan Table
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number')->unique();
            $table->string('donor_name');
            $table->string('pan_number')->nullable();
            $table->string('email');
            $table->string('mobile_number');
            $table->string('seva_cause'); // Annadanam, Gau Seva, Vidyadaan, Mandir Nirman
            $table->decimal('amount', 10, 2);
            $table->string('payment_mode')->default('UPI'); // UPI, Net Banking, Card, Cash
            $table->string('payment_status')->default('verified');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 4. Temple Events & Utsavs Table
        Schema::create('temple_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Grand Mahotsav');
            $table->string('event_date');
            $table->string('timings')->nullable();
            $table->string('expected_crowd')->default('10,000+ Devotees');
            $table->string('coordinator')->default('Mandir Trust Committee');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('Upcoming'); // Upcoming, Scheduled, Completed
            $table->timestamps();
        });

        // 5. Temple Facilities Table (Dharmashala, Annakshetra, Gaushala, etc.)
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('capacity');
            $table->string('occupancy');
            $table->string('incharge');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('Operational');
            $table->timestamps();
        });

        // 6. Photo & Media Gallery Table
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category'); // Sanctum Darshan, Daily Aartis, Heritage, Festivals
            $table->string('image_path');
            $table->text('caption')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('temple_events');
        Schema::dropIfExists('donations');
        Schema::dropIfExists('pooja_bookings');
        Schema::dropIfExists('poojas');
    }
};
