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
        foreach ($user as $s) {
            $count += $s->books()->count();
        }

        return response()->json([
            'av_books' => Book::count(),
            'av_bookings' => $count,
        ], 200);
    }
    /**
     * Display a listing of the resource to public
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Dynamic Query based on search input and category 🔍

        $books = Book::when($request->input('search') ?? '', function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")->orderBy('title', 'asc');
        })
            ->with('categories')
            ->paginate(6);

        return response()->json($books, 200);
    }

    /*
    *  Display a listing of the resource to librarians.
    */

    public function librarianIndex(Request $request)
    {
        /*
        * Dynamic Query based on search input and category 🔍
        * My Favourite Query Builder 🤩
        */
        $books = Book::when($request->input('search') ?? '', function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")->orderBy('title', 'asc');
        })
            ->when($request->input('category') ?? '', function ($query, $category) {
                $query->whereHas('categories', function ($query) use ($category) {
                    $query->where('name', $category);
                });
            })
            ->with('categories')
            ->withCount('users')
            ->paginate(10);

        return response()->json($books, 200);
    }

    public function userBooks($id)
    {
        $user = User::find($id);
        $books = $user->books()->get();
        return response()->json($books, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'quantity' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'title.required' => 'Il titolo è obbligatorio',
            'quantity.required' => 'La quantità è obbligatoria',
            'image.image' => 'Il file deve essere un\'immagine',
            'image.mimes' => 'Il file deve essere un\'immagine',
            'image.max' => 'Il file deve essere un\'immagine',
        ]);
        $book = new Book;
        $book->title = $request->title; // string
        $book->author = $request->author; // string
        $book->description = $request->description; // text
        $book->isbn = $request->isbn; //string
        $book->publisher = $request->publisher; // string
        $book->quantity = $request->quantity; // integer

        // Upload Image
        $filename = $request->image->getClientOriginalName();
        $path = $request->image->storeAs('images/books', $filename, 'public');
        $book->image = $path;
        $book->save();
        if($request->category) {
            $request->category->each(function ($category) use ($book) {
                $book->categories()->attach($category);
            });
        }

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
        $book = Book::find($id)->with('categories')->first();
        return response()->json($book, 200);
    }

    /**
     * Update the Book resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string',
                'quantity' => 'required|integer',
            ],
            [
                'title.required' => 'Titolo richiesto',
                'quantity.required' => 'Quantità richiesta',
            ]
        );

        $book = Book::find($request->id)->first()->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'isbn' => $request->isbn,
            'publisher' => $request->publisher,
            'quantity' => $request->quantity,
        ]);

        return response()->json(['message' => 'Libro modificato con successo'], 201);
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
        $book->delete();
        return response()->json(
            ['message' => 'Libro eliminato con successo'],
            200
        );
    }

    public function categories()
    {
        $categories = Category::select('name', 'id')->get(); // Return array of categories
        return response()->json($categories, 200);
    }

    /* Update image */
    public function updateImage($id, Request $request)
    {
        $request->validate(
            [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ],
            [
                'image.required' => 'Seleziona un\'immagine',
                'image.image' => 'Il file selezionato non è un\'immagine',
                'image.mimes' => 'Il file selezionato non è un\'immagine',
                'image.max' => 'L\'immagine deve essere di massimo 1MB',
            ]
        );

        $book = Book::find($id)->first();
        //Get original file name
        $filename = $request->image->getClientOriginalName();
        $path = $request->image->storeAs('images/books', $filename, 'public');
        // Store Book
        $book->update([
            'image' => $path
        ]);

        return response()->json([
            'image' =>  $book->image,
            'message' => 'Immagine aggiornata con successo'
        ], 201);
    }

    public function singleBook($id)
    {

        $book = Book::where('id', $id)->with('categories')->first();
        return response()->json($book, 200);
    }
}
