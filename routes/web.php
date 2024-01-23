<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/search', [BookController::class, 'search'])->name('search');

Route::get('/borrow/{bookId}', [BookController::class, 'showBorrowForm'])->name('borrow.form');

Route::post('/borrow', [BookController::class, 'borrowBook'])->name('borrow');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route for login
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login.form');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');

// Route for logout 
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/member_library', [App\Http\Controllers\AdminController::class, 'member_library'])->name('admin.member_library');
});