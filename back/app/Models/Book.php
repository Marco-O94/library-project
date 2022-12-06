<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function users() {
        return $this->belongsToMany(User::class);
    }

    protected $fillable = [
        'title',
        'author',
        'description',
        'publisher',
        'isbn',
        'image',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function BookedUsers()
    {
        return $this->belongsToMany(User::class, 'book_user', 'book_id', 'user_id');
    }
}
