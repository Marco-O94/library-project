<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;

class BookController extends Controller
{
    public function booksCount()
    {
        $user = User::all();
        $count = $user->books()->count();

        return response()->json([
                'av_books' => Book::count(),
                'av_bookings' => $count,
            ], 201);
    }
}
