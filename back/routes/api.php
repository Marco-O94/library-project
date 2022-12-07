<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;

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

Route::middleware('auth:sanctum')->group(function () {
    /*Route::get('/user', function (Request $request) {
        return $request->user();
    });*/
Route::post('logout', [AuthController::class, 'logout']);


});

/* Login - Logout - Register Routes  */
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});
Route::get('/books/count', [BookController::class, 'booksCount']);
Route::get('/user/books/{id}', [BookController::class, 'userBooks']);

//Route::group(['middleware' => 'auth:sanctum'], function () {
//    Route::post('logout', [AuthController::class, 'logout']);
//});

