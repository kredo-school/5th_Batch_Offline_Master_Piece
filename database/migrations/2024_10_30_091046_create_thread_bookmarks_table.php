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
        Schema::create('thread_bookmarks', function (Blueprint $table) {
            $table->unsignedBigInteger('guest_id');
            $table->unsignedBigInteger('thread_id');

            $table->foreign('guest_id')->references('id')->on('users');
            $table->foreign('thread_id')->references('id')->on('threads');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thread_bookmarks');
    }
};
