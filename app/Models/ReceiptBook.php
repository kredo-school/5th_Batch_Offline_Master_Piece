<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptBook extends Model
{
    use HasFactory;

    protected $table = 'receipt_book';
    protected $fillable = ['receipt_id', 'book_id', 'quantity'];

    public function receipt(){
        return $this->belongsTo(Receipt::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

}
