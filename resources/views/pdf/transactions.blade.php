<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transactions Report</title>
    <style>
        /* Add your CSS styles here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Transactions Report</h1>

    <table>
        <thead>
            <tr>
                <th>Borrower</th>
                <th>Book</th>
                <th>Time Session</th>
                <th>Date Reserved</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->borrowerUser->name }}</td>
                <td>{{ $transaction->borrowerBook->title }}</td>
                <td>{{ $transaction->ampm_session }}</td>
                <td>{{ (new DateTime($transaction->borrowed_date))->format('F j, Y') }}</td>
                <td>
                    @if ($transaction->status == "request")
                        <span class="badge badge-warning">{{ $transaction->status }}</span>
                    @else
                        <span class="badge badge-success">{{ $transaction->status }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
