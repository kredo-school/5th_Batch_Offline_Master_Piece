<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    // Allow mass assignment
    protected $fillable = ['user_id', 'book_id']; // data is of type array, we will insert the data using the create() method
    // save(), create() or createMany()
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class); 
    }

    public function book(){
        return $this->belongsTo(Book::class); 
    }
}
