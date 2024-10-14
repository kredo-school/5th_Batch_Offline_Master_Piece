<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'thread_id',
        'guest_id',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
