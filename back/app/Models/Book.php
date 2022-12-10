<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

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

    protected $hidden = [
        'created_at',
        'updated_at',

    ];


    public function categories()
    {
        return $this->belongsToMany(Category::class)->using(BookCategory::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(BookUser::class);
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image'] == null) {
            return null;
        } else {
            return url(Storage::url($this->attributes['image']));
        }
    }
}
