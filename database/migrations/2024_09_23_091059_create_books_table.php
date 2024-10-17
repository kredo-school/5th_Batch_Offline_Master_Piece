<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
        $table->id(); 
        $table->string('title'); 
        $table->text('description');
        $table->date('publication_date'); 
        $table->string('publisher'); 
        $table->string('isbn_code')->unique(); 
        $table->decimal('price', 8, 2); 
        $table->longText('image');
        
        $table->timestamp('deleted_at')->nullable();
        });
    }
    // up はmigrateした時に行われる動作

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }

    //ロールバックした時に行われる動作　down
};
