<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'school',
        'grade',
        'class',
        'user_id',
    ];

    // Student can have one user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
