<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    use HasFactory;

    use SoftDeletes;

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
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
