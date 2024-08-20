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
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', total: 9, places: 2);
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_store');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_store')->references('id')->on('stores');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_products');
    }
};
