<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Category;

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

        return response()->json($books, 201);
    }

    public function userBooks($id)
    {
        $user = User::find($id);
        $books = $user->books()->get();
        return response()->json($books, 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::all();
        return response()->json($categories, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book;
        $book->title = $request->title; // string
        $book->author = $request->author; // string
        $book->description = $request->description; // text
        $book->isbn = $request->isbn; //string
        $book->publisher = $request->publisher; // string
        $book->quantity = $request->quantity; // integer

        // Upload Image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/books/images');
            $image->move($destinationPath, $name);
            $book->image = $name;
        }
        $book->save();
        $book->attach($request->category);

        return response()->json([
            'message' => 'Libro creato con successo'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id)->categories()->get();
        return response()->json($book, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validateWithBag('updateBook', [
            'title' => 'required|string',
            'quantity' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string',
        ],
        [
            'title.required' => 'Titolo richiesto',
            'quantity.required' => 'Quantità richiesta',
            'category.required' => 'Categoria richiesta',
        ]);

        $book = Book::find($id);
        $book->title = $request->title; // string
        $book->author = $request->author; // string
        $book->description = $request->description; // text
        $book->isbn = $request->isbn; //string
        $book->publisher = $request->publisher; // string
        $book->quantity = $request->quantity; // integer

        // Upload Image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/books/images');
            $image->move($destinationPath, $name);
            $book->image = $name;
        }
        $book->save();
        $book->attach($request->category);

        return response()->json([
            'message' => 'Libro modificato con successo'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->detach();
        $book->delete();
        return response()->json([
            'message' => 'Libro eliminato con successo'
        ], 201);
    }
}
