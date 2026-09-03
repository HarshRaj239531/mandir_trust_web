<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Mandir Administrator (for /mandiradmin)
        User::firstOrCreate(
            ['email' => 'mandiradmin@gmail.com'],
            [
                'name' => 'Mandir Trust Head Administrator',
                'nickname' => 'Mandir Administrator',
                'mother_name' => 'Maa Jagadamba',
                'gender' => 'other',
                'dob' => '1980-01-01',
                'mobile_number' => '9876543210',
                'whatsapp_number' => '9876543210',
                'pincode' => '110001',
                'password' => Hash::make('Admin@12345'),
                'is_admin' => true,
                'status' => 'active',
            ]
        );

        // 2. Create Sample Devotee User
        User::firstOrCreate(
            ['email' => 'ramesh.bhakt@gmail.com'],
            [
                'name' => 'Ramesh Chandra Sharma',
                'nickname' => 'ShivBhakt_Ramesh',
                'mother_name' => 'Smt. Shanti Devi',
                'gender' => 'male',
                'dob' => '1992-06-15',
                'mobile_number' => '9812345678',
                'whatsapp_number' => '9812345678',
                'pincode' => '221001',
                'password' => Hash::make('Bhakt@12345'),
                'is_admin' => false,
                'status' => 'active',
            ]
        );

        // 3. Create Another Sample Devotee User
        User::firstOrCreate(
            ['email' => 'sunita.verma@gmail.com'],
            [
                'name' => 'Sunita Kumari Verma',
                'nickname' => 'RadhaRani_Sunita',
                'mother_name' => 'Smt. Kamla Devi',
                'gender' => 'female',
                'dob' => '1995-11-20',
                'mobile_number' => '9876501234',
                'whatsapp_number' => '9876501234',
                'pincode' => '302001',
                'password' => Hash::make('Bhakt@12345'),
                'is_admin' => false,
                'status' => 'active',
            ]
        );
        // 4. Seed Dynamic Mandir CMS (Poojas, Bookings, Donations, Events, Facilities, Galleries)
        $this->call(MandirCmsSeeder::class);

        // 5. Seed MLM Master Root Accounts (DS101010101010, DS100100100100, DS100010001000)
        $this->call(MlmRootAccountsSeeder::class);
    }
}
