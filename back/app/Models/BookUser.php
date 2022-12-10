<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * That's the pivot table between books and users - it's a many-to-many relationship
 * and let books to be borrowed by users and librarians can see who borrowed what book or create
 * new borrowings.
 */
class BookUser extends Pivot
{
    protected $table = 'book_user';

    protected $fillable = [
        'book_id',
        'user_id',
        'due_date',
    ];

    protected $hidden = [
        'updated_at',
        'book_id',
        'user_id',

    ];


    // Casting due_date as date and created_at as date with custom format 😁
    protected $casts = [
        'due_date' => 'date:d/m/Y',
        'created_at' => 'date:d/m/Y'
    ];




}
