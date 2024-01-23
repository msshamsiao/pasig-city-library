<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\RegisterController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

// Routes for searching books
Route::get('/search', [BookController::class, 'search']);

// Routes for borrowing and returning books
Route::post('/borrow/{bookId}/{userId}', [BookController::class, 'borrowBook']);
Route::post('/return/{bookId}/{userId}', [BookController::class, 'returnBook']);

// Routes for user registration and profile
Route::post('/register', [BookController::class, 'registerUser']);
Route::get('/user/{userId}', [BookController::class, 'getUserProfile']);

// Routes for book reservations
Route::post('/reserve/{bookId}/{userId}', [BookController::class, 'reserveBook']);

// Route for getting borrowing history
Route::get('/history/{userId}', [BookController::class, 'getBorrowingHistory']);

// Route for registering a profile using QR Code
Route::post('/register-from-qr-code', [BookController::class, 'registerFromQRCode']);

// Route for registering a user
Route::post('register', [RegisterController::class, 'register']);

// Route for approve transaction by librarian
Route::put('/approve-transaction/{transactionId}', [LibrarianController::class, 'approveTransaction']);
