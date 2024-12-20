<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function thread_genres()
    {
        return $this->hasMany(ThreadGenre::class);
    }
    public function genre_book()
    {

        return $this->belongsToMany(Genre::class, 'genre_books');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'genre_books', 'genre_id', 'book_id');
    }

    public function threads()
    {
        return $this->belongsToMany(Thread::class, 'thread_genres');
    }
}
