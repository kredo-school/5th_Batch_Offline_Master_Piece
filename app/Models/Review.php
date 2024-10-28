<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Review extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'guest_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLiked()
    {
        return $this->likes()->where('guest_id', Auth::user()->id)->exists();
    }

    
}
