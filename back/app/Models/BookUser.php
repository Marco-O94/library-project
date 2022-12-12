<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * That's the pivot table between books and users - it's a many-to-many relationship
 * and let books to be loaned by users and librarians can see who loaned what book or create
 * new loanings.
 */
class BookUser extends Pivot
{
    protected $table = 'book_user';

    protected $fillable = [
        'book_id',
        'user_id',
        'due_date',
        'status_id'
    ];

    protected $hidden = [
        'updated_at',
    ];


    // Casting due_date as date and created_at as date with custom format 😁
    protected $casts = [
        'due_date' => 'date:d/m/Y',
        'created_at' => 'date:d/m/Y'
    ];

    protected $attributes = [
        'status_id' => 1
    ];

}
