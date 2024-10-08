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
        Schema::create('reserves', function (Blueprint $table) {
            $table->unsignedBigInteger('guest_id');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('store_id');
            $table->integer('amount');
            $table->string('reservation_number');
            $table->timestamps();

            $table->foreign('guest_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};
