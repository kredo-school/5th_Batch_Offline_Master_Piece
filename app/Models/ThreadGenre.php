<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreadGenre extends Model
{
    use HasFactory;

    protected $table = 'thread_genres';
    protected $fillable = ['thread_id', 'genre_id'];
    public $timestamps = false;
}
