<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
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

    /**
     * Get the loanings of the status
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @see \App\Models\BookUser
     * @see \App\Models\Status
     *
     */

    public function loanings() {
        return $this->hasMany(BookUser::class);
    }
}
