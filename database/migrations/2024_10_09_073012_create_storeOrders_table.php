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
        Schema::create('store_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id')->onDelete('cascade');  // 商品のIDを外部キーとして保存
            $table->unsignedBigInteger('user_id')->onDelete('cascade');  // 商品のIDを外部キーとして保存
            $table->integer('quantity');  // 発注する個数
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('book_id')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_orders');
    }
};
