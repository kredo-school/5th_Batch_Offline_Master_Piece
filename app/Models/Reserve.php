<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Reserve extends Model
{
    protected $fillable = [
        'reservation_number',
    ];

    use HasFactory;
    use SoftDeletes;

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function store()
    {
        return $this->belongsTo(User::class, 'store_id');
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'book_id', 'book_id')->where('store_id', $this->store_id);
    }

    public function author_books()
    {
        return $this->hasMany(AuthorBook::class, 'book_id');
    }

    public function store_inventory()
    {
        return $this->hasOne(Inventory::class, 'store_id', 'store_id')->where('book_id', $this->book_id);
    }

    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }
}
