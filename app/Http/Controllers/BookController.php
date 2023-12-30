<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $books = Book::when($searchTerm, function ($query) use ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('subject', 'like', '%' . $searchTerm . '%')
                ->orWhere('author', 'like', '%' . $searchTerm . '%')
                ->orWhere('isbn', 'like', '%' . $searchTerm . '%')
                ->orWhere('issn', 'like', '%' . $searchTerm . '%');
        })->get();

        return response()->json(['success' => true, 'books' => $books, 'searchTerm' => $searchTerm], 200);
    }

    public function borrowBook(Request $request, $bookId, $userId)
    {
        $book = Book::findOrFail($bookId);
        $user = User::findOrFail($userId);

        // Check if the book is available for borrowing
        if (!$book->available) {
            return response()->json(['error' => 'Book is not available for borrowing'], 400);
        }

        // Check if the user has already borrowed the maximum allowed number of books
        $borrowedBooksCount = Transaction::where('user_id', $user->id)
            ->where('borrowed', true)
            ->count();

        if ($borrowedBooksCount >= 3) {
            return response()->json(['error' => 'User has already borrowed the maximum allowed number of books'], 400);
        }

        // Implement borrowing logic here
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Update book availability
            $book->update(['available' => false]);

            // Create a transaction record
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'borrowed' => true,
            ]);

            // Commit the transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Book borrowed successfully',
                'transaction' => $transaction,
            ], 200);
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();

            return response()->json(['error' => 'Failed to borrow the book'], 500);
        }
    }

    public function returnBook(Request $request, $bookId, $userId)
    {
        $book = Book::findOrFail($bookId);
        $user = User::findOrFail($userId);

        // Implement returning logic here
        if ($book->available) {
            return response()->json(['error' => 'Book is already available'], 400);
        }

        $transaction = Transaction::where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->where('borrowed', true)
            ->latest()
            ->first();

        if (!$transaction) {
            return response()->json(['error' => 'Book was not borrowed by the user'], 400);
        }

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Update book availability to mark it as returned
            $book->update(['available' => true]);

            // Update transaction record to mark the book as returned
            $transaction->update(['borrowed' => false]);

            // Commit the transaction
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Book returned successfully'], 200);
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();

            return response()->json(['error' => 'Failed to return the book'], 500);
        }

        return response()->json(['success' => true, 'message' => 'Book returned successfully'], 200);
    }

    public function getUserProfile($userId)
    {
        $user = User::findOrFail($userId);

        return response()->json(['success' => true, 'user' => $user], 200);
    }

    public function getBorrowingHistory($userId)
    {
        $user = User::findOrFail($userId);
        $transactions = Transaction::where('user_id', $userId)->get();

        return response()->json(['success' => true, 'transactions' => $transactions], 200);
    }

    public function reserveBook(Request $request, $bookId, $userId)
    {
        // Implement reservation logic here
        $book = Book::findOrFail($bookId);
        $user = User::findOrFail($userId);

        if (!$book->available) {
            return response()->json(['error' => 'Book is not available for reservation'], 400);
        }

        // Check if the user has an existing reservation for the same book
        $existingReservation = Reservation::where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->where('reserved', true)
            ->first();

        if ($existingReservation) {
            return response()->json(['error' => 'User already has a reservation for this book'], 400);
        }

        // Implement reservation logic here
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Create a reservation record
            $reservation = Reservation::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'reserved' => true,
            ]);

            // Commit the transaction
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Book reserved successfully', 'reservation' => $reservation], 200);
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();

            return response()->json(['error' => 'Failed to reserve the book'], 500);
        }
    }

    public function registerFromQRCode(Request $request)
    {
        $qrCodeData = $request->input('qr_code_data');

        // Process the QR code data and register the user
        $user = User::where('qr_code_data', $qrCodeData)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Update the registration status or perform other actions based on your logic
        $user->update(['registration_status' => 'registered']);

        return response()->json(['success' => true, 'message' => 'User registered from QR code'], 200);
    }
}
