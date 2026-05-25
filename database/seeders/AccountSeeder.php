<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        Account::insert([
            [
                'username' => 'john_doe',
                'currency' => 'MYR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'alice_lee',
                'currency' => 'SGD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'mike_tan',
                'currency' => 'USD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'sarah_lim',
                'currency' => 'MYR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
