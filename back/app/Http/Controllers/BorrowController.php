<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

class BorrowController extends Controller
{

    /**
     * Get a book by User
     *
     * @return \Illuminate\Http\Response
     */

    public function getBook(Request $request)
    {
        $user = User::findOrFail($request->user()->id);
        if ($user->books()->where('book_id', $request->book_id)->count() >= Book::where('id', $request->book_id)->quantity) {
            return response()->json([
                'message' => 'Questo libro non è al momento disponibile'
            ], 400);
        }

        if($user->role()->name == 'Student') {
            $user->books()->attach($request->book_id);
        } else {
            // 30 days from now
            $due_date = now()->addDays(30);
            $user->books()->attach($request->book_id, ['due_date' => $due_date]);
        }

        return response()->json([
            'message' => 'Libro preso in prestito con successo'
        ], 201);
    }

    /**
     * Create a borrow book request
     *
     */

    public function giveBook(Request $request) {

        $request->validate([
            'due_date' => 'date|after:today',
        ],
        [
            'due_date.date' => 'La data di restituzione deve essere una data valida',
            'due_date.after' => 'La data di restituzione deve essere successiva a oggi',
        ]
    );

    $user = User::findOrFail($request->id);
    if ($user->books()->where('book_id', $request->book_id)->count() >= Book::where('id', $request->book_id)->quantity) {
        return response()->json([
            'message' => 'Non ci sono più libri disponibili'
        ], 400);
    }

    if($user->role()->name == 'Student' && $user->books()->where('due_date', '<', now())->count() >= 3) {
        return response()->json([
            'message' => 'Non puoi prendere in prestito più di 3 libri'
        ], 400);
    }

    if($user->role()->name == 'Student') {
        $user->books()->attach($request->book_id);
    } else {
        $user->books()->attach($request->book_id, ['due_date' => $request->due_date]);
    }

    return response()->json([
        'message' => 'Libro preso in prestito con successo'
    ], 201);
    }

    /**
     * Delete user borrowed book
     *
     * @return \Illuminate\Http\Response
     */

    public function returnBook(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->books()->detach($request->book_id);

        return response()->json([
            'message' => 'Libro restituito con successo'
        ], 200);
    }

    /**
     * Get all Borrowed Books
     *
     * @return \Illuminate\Http\Response
     */

    public function borrowedBooks()
    {
        $books = User::whereHas('books')->with('books')->paginate(10);

        return response()->json($books, 200);
    }

    /**
     * Get One Borrowed Book
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function borrowedBook($id) {
        $book = User::whereHas('books')->with('books')->findOrFail($id);
        return response()->json($book, 200);
    }

    /**
     * Update due_date of borrowed book
     *
     * @return \Illuminate\Http\Response
     */

    public function updateDueDate($id, Request $request)
    {
        $request->validate(
            [
                'due_date' => 'date|after:today',
            ],
            [
                'due_date.date' => 'La data di restituzione deve essere una data valida',
                'due_date.after' => 'La data di restituzione deve essere successiva a oggi',
            ]
        );

        $user = User::findOrFail($id);
        $user->books()->updateExistingPivot($request->book_id, ['due_date' => $request->due_date]);

        return response()->json([
            'message' => 'Data di restituzione aggiornata con successo'
        ], 200);
    }
}
