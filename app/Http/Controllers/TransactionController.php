<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function list(Request $request)
    {
        $transactions = Transaction::select(
            'id',
            'wallet_id',
            'type',
            'amount',
            'created_at'
        )
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions', compact('transactions'));
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|integer',
            'amount'    => 'required|numeric|min:1',
        ]);

        $now = now();
        $wallet = Wallet::find($request->wallet_id);

        if (!$wallet) {
            return response()->json([
                'success' => false,
                'message' => 'Wallet not found'
            ], 404);
        }

        // update wallet balance
        $wallet->balance += $request->amount;
        $wallet->save();

        // create transaction record
        $transaction = Transaction::create([
            'wallet_id'  => $wallet->id,
            'type'       => 'deposit',
            'amount'     => $request->amount,
            'created_at' => $now,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Deposit successful',
            'data' => [
                'wallet_balance' => $wallet->balance,
                'transaction'    => $transaction,
            ]
        ]);
    }
}
