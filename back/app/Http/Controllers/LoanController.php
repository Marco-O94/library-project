<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\BookUser;
use App\Models\LoanStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class LoanController extends Controller
{

    /**
     * Create a loan book request
     *
     */

     /* TOO LATE
    public function giveBook(Request $request)
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

        $user = User::findOrFail($request->id);
        if ($user->books()->where('book_id', $request->book_id)->count() >= Book::where('id', $request->book_id)->quantity) {
            return response()->json([
                'message' => 'Non ci sono più libri disponibili'
            ], 400);
        }

        if ($user->role()->name == 'Student' && $user->books()->where('due_date', '<', now())->count() >= 3) {
            return response()->json([
                'message' => 'Non puoi prendere in prestito più di 3 libri'
            ], 400);
        }

        if ($user->role()->name == 'Student') {
            $user->books()->attach($request->book_id);
        } else {
            $user->books()->attach($request->book_id, ['due_date' => $request->due_date]);
        }

        return response()->json([
            'message' => 'Libro preso in prestito con successo'
        ], 201);
    }*/

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
    public function updateLoanStatus(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        //Get user role and check if the user is a student
        $userRole = $user->role()->first();
            if($request->status_id == 1) {
                $user->books()->updateExistingPivot($request->book_id, ['due_date' => null]);
            }

            else if($request->status_id == 2 && $userRole != 'Student') {
                $user->books()->updateExistingPivot($request->book_id, ['due_date' => Carbon::now()->addDays(30)->format('Y-m-d')]);
            }else if($request->status_id == 3 && $user->books()->where('book_id', $request->book_id)
            ->first()
            ->pivot->due_date > Carbon::now()->format('Y-m-d')){
                return response()->json([
                    'message' => 'La data dice il contrario...'
                ], 400);
            }
            $user->books()->updateExistingPivot($request->book_id, ['status_id' => $request->status_id]);
        return response()->json([
            'message' => 'Stato aggiornato con successo'
        ], 200);
    }

    public function getStatuses()
    {

        /* No mutch time */
        $statuses = LoanStatus::select('id', 'name')->get();
        return response()->json($statuses, 200);
    }

    /**
     * Complex query for loaned books
     * @param Request $request
     * @return \Illuminate\Http\Response
     */

    /* Needs to be refactored with model scopes */

    public function queryLoans(Request $request)
    {
        $query = BookUser::query()
            ->join('books', 'book_user.book_id', '=', 'books.id')
            ->join('users', 'book_user.user_id', '=', 'users.id')
            ->join('loan_statuses', 'book_user.status_id', '=', 'loan_statuses.id')
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
                return $query->where('book_user.status_id', $status);
            })
            ->select(
                'book_user.due_date',
                'book_user.created_at',
                'books.title',
                'users.name',
                'users.id as user_id',
                'books.id as book_id',
                'loan_statuses.name as status_name',
                'loan_statuses.id as status_id',
                'loan_statuses.color as status_color'
            )
            ->paginate(10);



        /* Temporary solution */

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
        $books = $user->books()->get();

        return response()->json($books, 200);
    }

     /**
     * Get a book my fellow User and Praise the Sun! 🌞
     *
     * @return \Illuminate\Http\Response
     */

     public function getBook($id)
     {
         $user = User::find(Auth::user()->id);

         // Check if the user has already borrowed the book
         if ($user->books()->where('book_id', $id)->count() > 0) {
             return response()->json([
                 'message' => 'Hai già preso in prestito questo libro'
             ], 400);
         } else {
             $user->books()->attach($id, ['status_id', 1]);

         return response()->json([
             'message' => 'Richiesta accettata, vai in libreria per ritirarlo'
         ], 201);
     }
     }
}
