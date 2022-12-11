<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LibrarianController;

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

    /* Shared Routes */

    Route::prefix('users')->controller(LibrarianController::class)->group(function () {
        // Show roles for User creation and Table
        Route::get('/roles', 'roles');
        // Delete User
        Route::delete('/', 'destroy');
    });


    /* Users Routes */
    Route::prefix('users')->controller(UserController::class)->group(function () {
        // Edit User
        Route::put('/selfupdate', 'update');
        // Change image to the User
        Route::post('/image', 'updateImage');
    });

    /* ---------- */

    /* ------ Librarian Routes ------ */
    Route::middleware('role:Librarian')->group(function () {

        Route::prefix('users')->controller(LibrarianController::class)->group(function () {
            // All Users
            Route::get('/', 'index');
            // Show User
            Route::get('/show/{id}', 'show');
            // Update User
            Route::put('/update', 'update');
            // Update Image
            Route::post('/image/{id}', 'updateImage');

            // Store a new User
            //Route::post('/store', 'store'); <-- Skipped for now

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

        /* Loan Routes */
        Route::prefix('loans')->controller(LoanController::class)->group(function () {
            // Return Book
            Route::delete('/', 'returnBook');
            // Update due_date of loaned book
            Route::put('/update/date/{id}', 'updateDueDate');
            // Update status of loaned book
            Route::put('/update/status/{id}', 'updateDueDate');
            // Show all Loaned Books
            Route::get('/', 'queryLoans');
            // Show Loaned Book
            Route::get('/{id}', 'loanedBook');
            // User get book
            Route::post('/create', 'getBook');
            // Librarian give book
            Route::post('/librarian/create', 'giveBook');
             // Get user loans
             Route::get('/user/{id}', 'userBooks');
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

Route::get('test', [LoanController::class, 'queryLoans']);
