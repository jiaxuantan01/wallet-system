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

//docker exec -it wallet_app php artisan migrate:fresh --seed
//docker exec -it wallet_app php artisan test
//docker compose up -d
//docker compose down
//docker logs wallet_app

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
