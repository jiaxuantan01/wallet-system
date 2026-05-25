<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    public function run(): void
    {
        Wallet::insert([
            [
                'account_id' => 1,
                'balance' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'account_id' => 2,
                'balance' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'account_id' => 3,
                'balance' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'account_id' => 4,
                'balance' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
