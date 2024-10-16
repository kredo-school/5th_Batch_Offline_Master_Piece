<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ADMIN_ROLE_ID = 1; #  Defines constant for admin role ID.
    const GUEST_ROLE_ID = 2; #  Defines constant for guest role ID.
    const STORE_ROLE_ID = 3; #  Defines constant for store role ID.

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $dates = ['deleted_at'];

    
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class,'guest_id');
    }
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class,'guest_id');
    }
    public function histories()
    {
        return $this->hasMany(History::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'guest_id');
    }

    public function storeOrders()
{
    return $this->hasMany(StoreOrder::class);
}

}
