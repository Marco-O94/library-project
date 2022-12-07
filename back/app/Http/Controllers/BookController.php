<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

class BookController extends Controller
{
    public function booksCount()
    {
        // Display Actual books and bookings
        $user = User::all();
        $count = 0;
        foreach($user as $s) {
            $count += $s->books()->count();
        }

        return response()->json([
                'av_books' => Book::count(),
                'av_bookings' => $count,
            ], 201);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Dynamic Query based on search input and category 🔍
        $books = fn () => Book::query()
            // Name Search
        ->when($request->input('search') ?? '', function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");})
            // Category Search
        ->when($request->input('category'), function ($query, $order) {
        $query->orderBy('name', $order);
        })->categories()->paginate(5);
    }

    public function userBooks($id)
    {
        $user = User::find($id);
        $books = $user->books()->get();
        return response()->json($books, 201);
    }

    public function book($id)
    {
        $book = Book::find($id)->categories()->get();
        return response()->json($book, 201);
    }
}
