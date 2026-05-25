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
        $transactions = Transaction::with([
            'wallet.account'
        ])
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

            $wallet = Wallet::where('id', $request->wallet_id)
                ->lockForUpdate()
                ->first();

            if (!$wallet) {
                return response()->json([
                    'success' => false,
                    'message' => 'Wallet not found'
                ], 404);
            }

            // deposit
            $amount = (float) $request->amount;
            $wallet->balance += $amount;

            Transaction::create([
                'wallet_id' => $wallet->id,
                'type'      => 'deposit',
                'amount'    => $amount,
            ]);

            // rebate
            $rebate = $amount * 0.01;
            $wallet->balance += $rebate;

            Transaction::create([
                'wallet_id' => $wallet->id,
                'type'      => 'rebate',
                'amount'    => $rebate,
            ]);

            $wallet->save();

            return response()->json([
                'success' => true,
                'balance' => number_format($wallet->balance,2)
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
                'balance' => number_format($wallet->balance,2)
            ]);
        });
    }

    public function getbalance(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|integer',
        ]);

        $wallet = Wallet::find($request->wallet_id);

        if (!$wallet) {
            return response()->json([
                'message' => 'Wallet not found'
            ], 404);
        }

        return response()->json([
            'wallet_id' => $wallet->id,
            'balance' => number_format($wallet->balance, 2)
        ]);
    }
}
