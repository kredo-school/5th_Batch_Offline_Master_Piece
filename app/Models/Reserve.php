<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $fillable = [
        'reservation_number',
    ];

    use HasFactory;

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
}
