<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class UserTransactionController extends Controller
{
    # this is for user transaction
    public function userTransaction()
    {
        $userTransactions = Transaction::with('borrowerUser')
        ->whereHas('borrowerUser', function($query) {
            $query->where('id', auth()->user()->id);
        })
        ->get();

        return view('admin.user_transaction',  ['userTransactions' => $userTransactions]);
    }
}
