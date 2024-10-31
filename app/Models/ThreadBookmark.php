<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThreadBookmark extends Model
{
    use HasFactory;
    protected $table = 'thread_bookmarks';
    protected $fillable = ['guest_id', 'thread_id'];
    public $timestamps = false;
}
