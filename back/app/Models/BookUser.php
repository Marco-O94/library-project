<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookUser extends Pivot
{
    protected $table = 'book_user';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
