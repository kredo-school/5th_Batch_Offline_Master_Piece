<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use HasFactory;
    use SoftDeletes;

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
        return $this->hasMany(Comment::class)->withTrashed();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'thread_genres');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }





}
