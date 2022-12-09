<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* ----- Authenticated Routes ----- */

/* --- Some Routes need to be refactored --- */
Route::middleware('auth:sanctum')->group(function () {
/* Logout */
Route::post('logout', [AuthController::class, 'logout']);

/* Users Routes */
Route::prefix('users')->controller(UserController::class)->group(function () {
    // All Users
    Route::get('/', 'index');
    // Books Booked by User
    Route::get('/books/{id}', 'userBooks');
    // Show single Book
    Route::get('/show/{id}', 'show');
    // Edit User
    Route::put('/update/{id}', 'update');
    // Delete User
    Route::delete('destroy/{id}', 'destroy');

    Route::post('/image', 'updateImage');

    Route::put('/selfupdate', 'selfUpdate');
});

/* ---------- */

/* ------ Librarian Routes ------ */
Route::middleware('role:Librarian')->group(function () {

/* Books Routes */
Route::prefix('books')->controller(BookController::class)->group(function () {
    // Show categories for Book creation
    Route::get('/create', 'create');
    // Store a new Book
    Route::post('/store', 'store');
    // Edit Book
    Route::put('/update', 'update');
    // Delete Book
    Route::delete('destroy/{id}', 'destroy');

    Route::get('/librarians/query', 'librarianIndex');

    Route::get('/categories', 'categories');

    Route::post('/image/{id}', 'updateImage');
});

/* Borrow Routes */
Route::prefix('borrow')->controller(BorrowController::class)->group(function () {
    // All Borrow
    Route::get('/', 'index');
    // Show single Borrow
    Route::get('/show/{id}', 'show');
    // Store a new Borrow
    Route::post('/store', 'store');
    // Edit Borrow
    Route::put('/update/{id}', 'update');
    // Delete Borrow
    Route::delete('destroy/{id}', 'destroy');
});

});
});
/* ---------- */



/* ----- Public Routes ----- */

/* Login  Register Routes  */
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::prefix('books')->controller(BookController::class)->group(function () {
    Route::get('/query', 'index');
    Route::get('/show/{id}', 'show');
    Route::get('/count', 'booksCount');
    Route::get('/single/{id}', 'singleBook');
});


/* ---------- */




