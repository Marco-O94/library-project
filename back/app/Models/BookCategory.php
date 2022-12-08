<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookCategory extends Pivot
{
    protected $table = 'book_category';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
