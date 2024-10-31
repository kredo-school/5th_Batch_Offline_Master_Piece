<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'guest_id');
    }
}
