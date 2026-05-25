<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

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

        return DB::transaction(function () use ($request) {

            $now = now();

            $wallet = Wallet::where('id', $request->wallet_id)
                ->lockForUpdate()
                ->first();

            if (!$wallet) {
                return response()->json([
                    'success' => false,
                    'message' => 'Wallet not found'
                ], 404);
            }

            $wallet->balance += $request->amount;
            $wallet->save();

            Transaction::create([
                'wallet_id'  => $wallet->id,
                'type'       => 'deposit',
                'amount'     => $request->amount,
                'created_at' => $now,
            ]);

            return response()->json([
                'success'     => true,
                'balance'     => $wallet->balance,
            ]);
        });
    }

    public function withdrawal(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|integer',
            'amount'    => 'required|numeric|min:1',
        ]);

        return DB::transaction(function () use ($request) {

            $now = now();

            $wallet = Wallet::where('id', $request->wallet_id)
                ->lockForUpdate()
                ->first();

            if ($wallet->balance < $request->amount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient balance'
                ], 400);
            }

            $wallet->balance -= $request->amount;
            $wallet->save();

            Transaction::create([
                'wallet_id'  => $wallet->id,
                'type'       => 'withdrawal',
                'amount'     => $request->amount,
                'created_at' => $now,
            ]);

            return response()->json([
                'success' => true,
                'balance' => $wallet->balance
            ]);
        });
    }
}
