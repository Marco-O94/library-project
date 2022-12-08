<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'image_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];
    // Return mutated value for image path


    protected $attributes = [
        'is_admin' => false, // Default value for is_admin
        'role_id' => 3, // 3 is the default role_id for Guests
    ];

    // User can book many books
    public function books() {
        return $this->belongsToMany(Book::class)->using(BookUser::class)->withPivot('borrow_date','expiration_date');
    }

    // User can have one role
    public function role() {
        return $this->belongsTo(Role::class);
    }

    // User can have one student profile
    public function student() {
        return $this->hasOne(Student::class);
    }

    /**
    * Get absolute image path with env url
    *
    * @return string
    */
    public function getImagePathAttribute() {
        return url(Storage::url($this->attributes['image_path']));
    }

}
