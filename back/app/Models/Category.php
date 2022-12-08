<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'color'
    ];

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at'

    ];

    public function books()
    {
        return $this->belongToMany(Book::class)->using(BookCategory::class);
    }

}
