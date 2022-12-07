<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // User can have many roles
    public function users() {
        return $this->hasMany(User::class, 'role_id');
    }

    protected $fillable = [
        'name',
        'color',
    ];

    protected $hidden = ['pivot'];
}
