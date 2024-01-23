<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class LibrarianController extends Controller
{
    public function approveTransaction($transactionId)
    {
        try {
            $transaction = Transaction::findOrFail($transactionId);

            // Perform librarian approval logic
            $transaction->update(['approved' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Transaction approved successfully.',
                'transaction' => $transaction,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to approve the transaction'], 500);
        }
    }
}
