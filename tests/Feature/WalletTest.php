<?php

namespace Tests\Feature;

use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WalletTest extends TestCase
{

    public function test_deposit_and_withdraw()
    {

        $wallet = Wallet::find(1);

        // deposit
        $depositResponse = $this->postJson('/api/deposit', [
            'wallet_id' => $wallet->id,
            'amount' => 100
        ]);

        // withdraw
        $withdrawResponse = $this->postJson('/api/withdrawal', [
            'wallet_id' => $wallet->id,
            'amount' => 50
        ]);

        $wallet->refresh();

        $this->assertEquals(151.00, $wallet->balance);
    }
}
