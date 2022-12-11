<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Symfony\Component\Console\Input\Input;
use App\Models\BookUser;
use App\Models\Status;


class LoanController extends Controller
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
     * Create a loan book request
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
     * Delete user loaned book
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
     * Get One Loaned Book
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function loanedBook($id) {
        $book = User::whereHas('books')->with('books')->findOrFail($id);
        return response()->json($book, 200);
    }

    /**
     * Update due_date of loaned book
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

    /**
     * Update status of loaned book
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->books()->updateExistingPivot($request->book_id, ['status' => $request->status]);

        return response()->json([
            'message' => 'Stato aggiornato con successo'
        ], 200);
    }

    public function getStatuses() {
        return response()->json(Status::all(), 200);
    }

    /**
     * Complex query for loaned books
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function queryLoans(Request $request) {
       $query = BookUser::query()
        ->join('books', 'book_user.book_id', '=', 'books.id')
        ->join('users', 'book_user.user_id', '=', 'users.id')
        ->when($request->input('search_user') ?? '', function ($query, $search_user) {
            return $query->where('users.name', 'like', '%' . $search_user . '%');
        })
        ->when($request->input('search_book') ?? '', function ($query, $search_book) {
            return $query->where('books.title', 'like', '%' . $search_book . '%');
        })
        ->when($request->input('search_due_date') ?? '', function ($query, $search_due_date) {
            return $query->where('book_user.due_date', 'like', '%' . $search_due_date . '%');
        })->when($request->input('sort') ?? '', function ($query, $sort) {
            return $query->orderBy($sort, 'asc');
        })->when($request->input('status') ?? '', function ($query, $status) {
            return $query->where('book_user.status', $status);
        })
        ->select('book_user.due_date', 'book_user.created_at', 'books.title', 'users.name', 'users.id as user_id', 'users.image_path as user_image', 'books.image as book_image', 'books.id as book_id', 'book_user.status')
        ->paginate(10);
        return response()->json($query, 200);
    }

    /**
     * Get user loaned books
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userBooks($id)
    {
        $user = User::find($id);
        $books = $user->books()->get()->withPivot();

        return response()->json($books, 200);
    }
}
