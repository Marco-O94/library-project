<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookUser extends Pivot
{
    protected $table = 'book_user';

    protected $fillable = [
        'book_id',
        'user_id',
        'status',
        'due_date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'Pivot'
    ];


    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
