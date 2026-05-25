<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f6f9;
            font-family: Arial, Helvetica, sans-serif;
            color: #1f2937;
        }

        .page {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .add-btn {
            background: #4f46e5;
            color: white;
            padding: 11px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f9fafb;
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
            font-size: 14px;
            border-bottom: 1px solid #eef0f3;
        }

        th {
            color: #6b7280;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
        }

        .amount.deposit,  .amount.rebate{
            color: #16a34a;
            font-weight: 700;
        }

        .amount.withdrawal {
            color: #dc2626;
            font-weight: 700;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
        }
    </style>
</head>

<body>
<div class="page">

    <div class="header">
        <h1>Transactions List</h1>
{{--        <a href="#" class="add-btn">+ Add Transaction</a>--}}
    </div>

    <div class="card">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Username</th>
                <th>Wallet ID</th>
                <th>Type</th>
                <th>Amount</th>
            </tr>
            </thead>

            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->wallet->account->username ?? '-' }}</td>
                    <td>{{ $transaction->wallet_id }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td class="amount {{ $transaction->type }}">{{ number_format($transaction->amount, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
