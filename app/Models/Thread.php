<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
    ];

    public function genre_threads()
    {
        return $this->hasMany(ThreadGenre::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
