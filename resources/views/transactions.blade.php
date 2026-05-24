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

        .amount.income {
            color: #16a34a;
            font-weight: 700;
        }

        .amount.expense {
            color: #dc2626;
            font-weight: 700;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge.income {
            background: #dcfce7;
            color: #15803d;
        }

        .badge.expense {
            background: #fee2e2;
            color: #b91c1c;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
        }

        .edit {
            color: #2563eb;
        }

        .delete {
            color: #dc2626;
        }
    </style>
</head>

<body>
<div class="page">
    <div class="header">
        <h1>Transaction List</h1>
        <a href="#" class="add-btn">+ Add Transaction</a>
    </div>

    <div class="card">
        <table>
            <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Category</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction['date'] }}</td>

                    <td>{{ $transaction['description'] }}</td>

                    <td>{{ $transaction['category'] }}</td>

                    <td>
                <span class="badge {{ $transaction['type'] }}">
                    {{ ucfirst($transaction['type']) }}
                </span>
                    </td>

                    <td class="amount {{ $transaction['type'] }}">
                        @if($transaction['type'] == 'income')
                            + RM {{ number_format($transaction['amount'], 2) }}
                        @else
                            - RM {{ number_format($transaction['amount'], 2) }}
                        @endif
                    </td>

                    <td class="actions">
                        <a href="#" class="edit">Edit</a>
                        <a href="#" class="delete">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
