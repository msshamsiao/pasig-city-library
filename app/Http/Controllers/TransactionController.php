<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\MemberLibrary;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Dompdf\Dompdf;
use Dompdf\Options;

class TransactionController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $memberLibraryId = $request->input('member_library');
        $category = $request->input('category');

        $query = Book::query();

        if ($memberLibraryId) {
            $query->whereHas('memberLibrary', function ($memberLibraryQuery) use ($memberLibraryId) {
                $memberLibraryQuery->where('id', $memberLibraryId);
            });
        }

        if ($category && $searchTerm) {
            $query->where($category, 'like', '%' . $searchTerm . '%');
        }

        $books = $query->get();

        if ($memberLibraryId && $category && $searchTerm && $books->isEmpty()) {
            $message = "This is not available for the selected Member Library. Please try another one.";
            return view('search', ['searchTerm' => $message]);
        }

        return view('search', ['books' => $books, 'searchTerm' => $searchTerm]);
    }

    public function showBorrowForm($bookId, $userId)
    {
        $book = Book::findOrFail($bookId);
        
        return view('borrow', [
            'book' => $book
        ]);
    }

    public function memberLibrary()
    {
        $memberLibraries = Memberlibrary::get();
        return view('borrow-form', ['memberLibraries' => $memberLibraries]);
    }

    public function borrowBook(Request $request, $bookId, $userId = null)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|integer|exists:books,id',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'member_library' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Check if the book exists
        $book = Book::find($request->input('book_id'));

        if (!$book) {
            return view('search', ['BookNotFound' => true]);
        }

        // Try to find the user by email, name, and member library
        $user = User::where([
            ['email', $request->input('user_email')],
            ['name', $request->input('user_name')],
            ['member_library', $request->input('member_library')],
        ])->first();

        // If the user doesn't exist, create a new user
        if (!$user) {
            $user = User::create([
                'name' => $request->input('user_name'),
                'email' => $request->input('user_email'),
                'password' => Hash::make($request->input('user_password')),
                'member_library' => $request->input('member_library'),
                'registration_status' => 'pending',
                'admin' => 0
            ]);
        }

        // Check if the book is available for borrowing
        if ($book->available == 0) {
            return view('search', ['BookNotAvailable' => true]);
        }

        // Check if the user has already borrowed the maximum allowed number of books
        $borrowedBooksCount = Transaction::where('user_id', $user->id)
            ->where('status', "borrowed")
            ->count();

        if ($borrowedBooksCount >= 3) {
            return view('search', ['MaxBookAllowed' => true]);
        }

        // Check if the book's school matches the user's member library
        if ($book->school !== $request->input('member_library')) {
            return view('search', ['NotFoundBook' => true]);
        }

        try {
            DB::beginTransaction();

            // Decrement the available count of books by 1
            $book->decrement('available');

            Transaction::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'status' => "borrowed",
                'borrowed_date' => now(),
            ]);

            DB::commit();

            // Redirect back to the search view with a success message
            return view('search', ['SuccessBorrow' => true]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to submit book borrowing request'], 500);
        }
    }

    public function returnBook($transactionId)
    {
        $transaction = Transaction::find($transactionId);

        if ($transaction) {
            $transaction->update([
                'status' => "completed",
                'return_date' => now(), 
            ]);
            return redirect()->back()->with('success', 'Transaction completed successfully');
        } else {
            return redirect()->back()->with('error', 'Transaction not found');
        }
    }

    public function reserveBook(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
        $user = User::where([
            ['email', $request->input('user_email')],
            ['name', $request->input('user_name')],
            ['member_library', $request->input('member_library')],
        ])->first();

        // Check if the book is available for reservation
        if (!$this->isBookAvailable($book->isbn, $request->date, $request->ampm_select)) {
            return Redirect::back()->withErrors(['error' => 'No available copies for this book']);
        }

        try {
            DB::beginTransaction();

            // Create a reservation record
            $reservation = Transaction::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'status' => "request",
                'reserved_date' => $request->date,
                'ampm_session' => $request->ampm_select
            ]);

            // Update copy count based on scheduled date and session
            $this->updateCopyCount('request', $book->isbn, $request->date, $request->ampm_select);

            DB::commit();

            return Redirect::back()->withSuccess('Successfully requested a book. Please wait for approval');

        } catch (\Exception $e) {
            DB::rollBack();

            return Redirect::back()->withErrors(['error' => 'Failed to reserve the book']);
        }
    }

    private function isBookAvailable($isbn, $scheduledDate, $session)
    {
        $book = Book::where('isbn', $isbn)->first();

        if (!$book) {
            // Handle case where book with given ISBN is not found
            return false;
        }

        // Check if the scheduled date and session are greater than the current date and session
        if ($scheduledDate > now()->toDateString() || ($scheduledDate == now()->toDateString() && $session == 'PM')) {
            return $book->available > 0; // Check if there are available copies
        } else {
            return true; // Books scheduled in the past are always available
        }
    }
 
    private function updateCopyCount($status, $isbn, $scheduledDate, $session)
    {
        $book = Book::where('isbn', $isbn)->first();

        if (!$book) {
            // Handle case where book with given ISBN is not found
            return;
        }

        $countToChange = ($status === 'request') ? 1 : -1;

        // Check if the scheduled date and session are greater than the current date and session
        if ($scheduledDate > now()->toDateString() || ($scheduledDate == now()->toDateString() && $session == 'PM')) {
            $book->available += $countToChange; // Increment available count
        } else {
            $book->available -= $countToChange; // Decrement available count
        }

        $book->save();
    }

    public function cancelBook($transactionId)
    {
        $transaction = Transaction::find($transactionId);

        if ($transaction) {
            
            $transaction->delete();

            return redirect()->back()->with('success', 'Transaction cancelled successfully');
        } else {
            return redirect()->back()->with('error', 'Transaction not found');
        }

    }

    public function getBorrowingHistory($userId)
    {
        $user = User::findOrFail($userId);
        $transactions = Transaction::where('user_id', $userId)->get();

        return response()->json(['success' => true, 'transactions' => $transactions], 200);
    }

    public function generatePdf()
    {
        // Fetch your data to include in the PDF
        $transactions = Transaction::all(); // Example data retrieval, adjust as needed

        // Load the view content into a variable
        $view = view('pdf.transactions', compact('transactions'))->render();

        // Create PDF options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        // Instantiate Dompdf
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($view);

        // (Optional) Set the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (generate the PDF content)
        $dompdf->render();

        // Output the generated PDF (stream it to the browser)
        return $dompdf->stream('transactions_report.pdf');
    }

    # this is for admin
    public function transaction(Request $request)
    {
        $transactions = Transaction::whereHas('borrowerUser', function($query) {
            $query->where('member_library', auth()->user()->member_library);
        })
        ->with('borrowerBook')
        ->when($request->has('filter_status') && $request->input('filter_status') !== 'all', function($query) use ($request) {
            $query->where('status', $request->input('filter_status'));
        })
        ->get();
    
        return view('admin.transaction', ['transactions' => $transactions]);    
    
    }
}
