<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BookUser;
use App\Models\User;
use App\Mail\ExpirationMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:check-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if a book is expired and send an email to the user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $users = BookUser::where('due_date', '<=', Carbon::now()->addDays(10))
      ->join('books', 'books.id', '=', 'book_user.book_id')
        ->join('users', 'users.id', '=', 'book_user.user_id')
        ->select('books.title', 'users.name','users.role_id', 'users.email','book_user.due_date','book_user.notified')
        ->get();

        $users->each(function($user) {
            if($user->notified == 0 && $user->role_id != 2) {
                $user->notified = 1;
                $user->save();
                Mail::to($user->email)->send(new ExpirationMail($user));
            }
        });
        return Command::SUCCESS;
    }
}
