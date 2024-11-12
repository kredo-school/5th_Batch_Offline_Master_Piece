<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // これを追加


class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes; // ここに追加

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
        'role_id', //register-storeにて追加
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

    public function storeBooks()
    {
        return $this->belongsToMany(Book::class, 'inventories', 'store_id', 'book_id')->withPivot('stock');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'guest_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'guest_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'guest_id');
    }


    public function reserves()
    {
        return $this->hasMany(Reserve::class, 'guest_id')->whereNull('reservation_number');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'store_id');
    }
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function store_book()
    {
        return $this->belongsToMany(Book::class, 'store_book', 'store_id');
    }

    public function store_guest()
    {
        return $this->belongsToMany(User::class, 'store_guest', 'store_id', 'guest_id');
    }

    public function storeOrders()
    {
        return $this->hasMany(StoreOrder::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'store_id');
    }


    public function store_reserves()
    {
        return $this->hasMany(Reserve::class, 'store_id')->whereNull('reservation_number');
    }

    public function order_stores()
    {
        return $this->belongsToMany(User::class, 'reserves', 'guest_id', 'store_id')->whereNull('reservation_number')->distinct();
    }

    public function store_reserved()
    {
        return $this->hasMany(Reserve::class, 'store_id')->whereNotNull('reservation_number')->latest();
    }

    public function isBookmarked($thread_id)
    {
        return $this->hasMany(ThreadBookmark::class, 'guest_id')->where('thread_id', $thread_id)->exists();
    }
}
