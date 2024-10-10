<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
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
}
