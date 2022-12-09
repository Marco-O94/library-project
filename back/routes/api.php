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


/* ❗ Api Routes have to be refactored with Route::resource ❗ */

/* ----- Authenticated Routes ----- */

/* --- Some Routes need to be refactored --- */
Route::middleware('auth:sanctum')->group(function () {
/* Logout */
Route::post('logout', [AuthController::class, 'logout']);

/* Users Routes */
Route::prefix('users')->controller(UserController::class)->group(function () {
    // Edit User
    Route::put('/update/{id}', 'update');
    // Delete User
    Route::delete('/{id}', 'destroy');
    // Change image to the User
    Route::post('/image', 'updateImage');
    // Change data to the User
    Route::put('/selfupdate', 'selfUpdate');
});

/* ---------- */

/* ------ Librarian Routes ------ */
Route::middleware('role:Librarian')->group(function () {

    Route::prefix('users')->controller(UserController::class)->group(function () {
        // All Users
        Route::get('/', 'index');
        // Store a new User
        //Route::post('/store', 'store'); <-- Skipped for now
        // Show single User
        Route::get('/show/{id}', 'show');
        // Show roles for User creation and Table
        Route::get('/roles', 'roles');

    });

/* Books Routes */
Route::prefix('books')->controller(BookController::class)->group(function () {
    // Show categories for Book creation
    Route::get('/create', 'create');
    // Store a new Book
    Route::post('/store', 'store');
    // Edit Book
    Route::put('/update', 'update');
    // Delete Book
    Route::delete('/{id}', 'destroy');
    // Show books for Librarian
    Route::get('/librarians/query', 'librarianIndex');
    // Show categories for Book creation and Table
    Route::get('/categories', 'categories');
    // Change image to the Book
    Route::post('/image/{id}', 'updateImage');
});

/* Borrow Routes */

/* That's what I'm trying to do */
Route::prefix('borrow')->controller(BorrowController::class)->group(function () {
    Route::resource('/', BorrowController::class);
});


}); // End of Librarian Routes
}); // End of Authenticated Routes


/* <(°.°<) <(°.°)> (>°.°)> */


/* ----- Public Routes ----- */

/* Login  Register Routes  */
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::prefix('books')->controller(BookController::class)->group(function () {
    // Show all Books for Public
    Route::get('/query', 'index');
    // Show single Book for Public
    Route::get('/show/{id}', 'show');
    // Count the Books
    Route::get('/count', 'booksCount');
    // Show single Book for Librarian
    Route::get('/single/{id}', 'singleBook');
});


/* ---------- */




