<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class TransactionController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function list(Request $request)
    {
        $transactions = [
            [
                'date' => '2026-05-24',
                'description' => 'Salary',
                'category' => 'Income',
                'type' => 'income',
                'amount' => 3500,
            ],
            [
                'date' => '2026-05-24',
                'description' => 'Lunch',
                'category' => 'Food',
                'type' => 'expense',
                'amount' => 15.50,
            ],
        ];

        return view('transactions', compact('transactions'));
    }

}
