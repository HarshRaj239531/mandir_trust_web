<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MlmRootAccountsSeeder extends Seeder
{
    /**
     * Seed the 3 Root Master Accounts for the MLM system:
     * 1. DS101010101010 - "DS SWAMI JEE"
     * 2. DS100100100100 - "DS SWAMI JEE"
     * 3. DS100010001000 - "DS SWAMI JEE"
     */
    public function run(): void
    {
        $rootAccounts = [
            [
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
            ],
            [
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
            ],
            [
                'member_id' => 'DS100010001000',
                'name' => 'DS SWAMI JEE',
                'nickname' => 'DS SWAMI JEE',
                'mother_name' => 'Maa Jagadamba',
                'gender' => 'other',
                'dob' => '1975-01-01',
                'email' => 'dsswamijee3@mandirtrust.org',
                'mobile_number' => '9900100010',
                'whatsapp_number' => '9900100010',
                'pincode' => '824231',
                'password' => Hash::make('Swami@12345'),
                'is_admin' => false,
                'status' => 'active',
            ],
        ];

        $rootUsers = [];
        foreach ($rootAccounts as $account) {
            $user = User::updateOrCreate(
                ['member_id' => $account['member_id']],
                $account
            );
            $rootUsers[$account['member_id']] = $user;
        }

        // Backfill member_id for any existing user without one
        $usersWithoutMemberId = User::whereNull('member_id')->get();
        foreach ($usersWithoutMemberId as $user) {
            $user->member_id = User::generateMemberId();
            if (!$user->is_admin && !$user->sponsor_id && isset($rootUsers['DS101010101010'])) {
                $user->sponsor_id = $rootUsers['DS101010101010']->id;
            }
            $user->save();
        }
    }
}
