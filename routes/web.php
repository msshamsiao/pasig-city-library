<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MemberLibraryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTransactionController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::get('/home.html', function () {
    return view('home');
});

Route::get('/about.html', function () {
    return view('about');
});

Route::get('/member_libraries.html', function () {
    return view('member_libraries');
});

Route::get('/search.html', function () {
    return view('search');
});

Route::get('/contact_us.html', function () {
    return view('contact_us');
});

Route::get('/borrow.html', function () {
    return view('borrow');
});

Route::get('/search', [TransactionController::class, 'search'])->name('search');

Route::get('/borrow/{bookId}', [TransactionController::class, 'showBorrowForm'])->name('borrow.form');

Route::post('/borrow', [TransactionController::class, 'borrowBook'])->name('borrow');

Route::post('/reserve/{bookId}', [TransactionController::class, 'reserveBook'])->name('reserve');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route for login
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login.form');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');

// Route for logout 
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {

    # dashboard
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::patch('/users/{userId}/approve', [AdminController::class, 'approveUser'])->name('users.approve');
    Route::patch('/users/{userId}/unapprove', [AdminController::class, 'unapproveUser'])->name('users.unapprove');

    # member library
    Route::get('/admin/member_library', [App\Http\Controllers\MemberLibraryController::class, 'member_library'])->name('admin.member_library');
    Route::get('/admin/member_library', [MemberLibraryController::class, 'index'])->name('admin.member_library');
    Route::post('/admin/member_library', [MemberLibraryController::class, 'store'])->name('members.store');
    Route::get('/admin/member_library/{member}/edit', [MemberLibraryController::class, 'edit'])->name('members.edit');
    Route::put('/admin/member_library/{member}', [MemberLibraryController::class, 'update'])->name('members.update');
    Route::delete('/admin/member_library/{member}', [MemberLibraryController::class, 'destroy'])->name('members.destroy');

    # user
    Route::get('/admin/user', [App\Http\Controllers\UserController::class, 'user'])->name('admin.user');
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');
    Route::post('/admin/user', [UserController::class, 'store'])->name('users.store');
    Route::get('/admin/user/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/user/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/admin/user/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/admin/user_transaction', [App\Http\Controllers\UserTransactionController::class, 'userTransaction'])->name('admin.user_transaction');

    # transaction
    Route::get('/admin/transaction', [App\Http\Controllers\TransactionController::class, 'transaction'])->name('admin.transaction');
    Route::patch('/transactions/{transactionId}/return', [App\Http\Controllers\TransactionController::class,'returnBook'])->name('transactions.return');
    Route::patch('/transactions/{transactionId}/cancel', [App\Http\Controllers\TransactionController::class,'cancelBook'])->name('transactions.cancel');
    Route::get('/transactions/generate-pdf', [TransactionController::class, 'generatePdf'])->name('transactions.generatePdf');

    # book library
    Route::get('/admin/book', [App\Http\Controllers\BookController::class, 'user'])->name('admin.book');
    Route::get('/admin/book', [BookController::class, 'index'])->name('admin.book');
    Route::post('/admin/book', [BookController::class, 'store'])->name('books.store');
    Route::get('/admin/book/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/admin/book/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/admin/book/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});