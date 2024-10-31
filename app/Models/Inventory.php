<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';
    protected $fillable = ['store_id', 'book_id', 'stock'];

    
   
    public function store()
    {
        return $this->belongsTo(User::class, 'store_id');
    }
       
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}

