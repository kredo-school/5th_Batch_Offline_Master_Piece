<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    public function receiptBook()
    {
        return $this->hasMany(ReceiptBook::class);
    }

    public function guest()
    {
        return $this->belongsToMany(User::class, 'user_id')->withTrashed();
    }

    # Use this method to get the info of the user being followed
    public function store()
    {
        return $this->belongsToMany(User::class, 'store_id')->withTrashed();
    }


}
