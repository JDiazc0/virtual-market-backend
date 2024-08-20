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
        Schema::create('ordered_items', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', total: 9, places: 3);
            $table->decimal('unit_value', total: 11, places: 2);
            $table->decimal('discounted_unit_value', total: 11, places: 2);
            $table->decimal('list_price', total: 12, places: 2);
            $table->decimal('final_value', total: 12, places: 2);
            $table->unsignedBigInteger('id_promotion');
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_order');
            $table->foreign('id_promotion')->references('id')->on('promotions');
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_order')->references('id')->on('orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordered_items');
    }
};
