<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Models\LoanStatus;
use Carbon\Carbon;

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

/* ----- BOOKS ----- */

Route::prefix('books')->controller(BookController::class)->group(function () {

    /* --- Public Routes --- */
    // Show all Books for Public
    Route::get('/', 'index');
    // Show single Book for Public
    Route::get('/show/{id}', 'show');
    // Count the Books
    Route::get('/count', 'booksCount');
    // Show single Book for Librarian
    Route::get('/single/{id}', 'singleBook');

    /* --- Authenticated Routes --- */
    Route::group(['middleware' => ['auth:sanctum', 'role:Librarian']], function () {
        // Show categories for Book creation
        Route::get('/create', 'create');
        // Store a new Book
        Route::post('/store', 'store');
        // Edit Book
        Route::put('/update', 'update');
        // Delete Book
        Route::delete('/delete/{id}', 'destroy');
        // Show books for Librarian
        Route::get('/librarians/query', 'librarianIndex');
        // Show categories for Book creation and Table
        Route::get('/categories', 'categories');
        // Change image to the Book
        Route::post('/image/{id}', 'updateImage');
    });
});

/* ----- LOANS ----- */

/* --- Authenticated Routes --- */
Route::group(
    [
        'prefix' => 'loans',
        'middleware' => ['auth:sanctum'],
        'controller' => LoanController::class
    ],



    function () {
        // User get book
        Route::post('/user/create/{id}', 'getBook');
        // Get user loans
        Route::get('/user/{id}', 'userBooks');

        /* --- Librarian Routes --- */
        Route::middleware('role:Librarian')->group(function () {
            // Return Book
            Route::delete('/', 'returnBook');
            // Update due_date of loaned book
            Route::put('/update/date/{id}', 'updateDueDate');
            // Update status of loaned book
            Route::put('/update/status', 'updateLoanStatus');
            // Show all Loaned Books
            Route::get('/', 'queryLoans');
            // Librarian give book
            Route::post('/librarian/create', 'giveBook');
            // Get loans Statuses
            Route::get('/statuses', 'getStatuses');
        });
    }
);


/* ----- USERS ----- */

Route::group(
    [
        'prefix' => 'users',
        'middleware' => ['auth:sanctum'],
        'controller' => UserController::class
    ],
    function () {
        // Show roles for User creation and Table
        Route::get('/roles', 'roles');
        /* --- Shared Routes --- */
        // Delete User
        Route::delete('/delete/{id}', 'destroy');
        // Edit User
        Route::put('/selfupdate', 'update');
        // Change User image
        Route::post('/image', 'updateImage');
        // Show User
        Route::get('/show/{id}', 'show');
        // Update User
        Route::put('/update', 'update');
        // All Users
        Route::get('/', 'index')->middleware('role:Librarian');
    }
);
//Route middleware + prefix


/* --- Main Routes --- */

/* Logout */
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
/* Login  Register Routes  */
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

/* <(°.°<) <(°.°)> (>°.°)> */
