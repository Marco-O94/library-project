<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
