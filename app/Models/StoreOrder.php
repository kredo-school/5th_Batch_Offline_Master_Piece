<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{
    use HasFactory;

     // マスアサインメント可能なフィールドを指定する
    protected $fillable = [
        'book_id',
        'store_id',
        'quantity',
    ];

    /**
      * Bookリレーション - StoreOrderは1つのBookに属する
      */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    
    /**
      * Storeリレーション - StoreOrderは1つのStoreに属する
      */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
