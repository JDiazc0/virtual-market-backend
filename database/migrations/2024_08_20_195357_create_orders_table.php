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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('instructions');
            $table->date('delivery_date');
            $table->decimal('product_value', total: 12, places: 2);
            $table->decimal('shipping_value', total: 10, places: 2);
            $table->decimal('discount_value', total: 12, places: 2);
            $table->decimal('taxes_value', total: 11, places: 2);
            $table->decimal('final_value', total: 12, places: 2);
            $table->decimal('rate', total: 3, places: 2);
            $table->string('address');
            $table->unsignedBigInteger('id_store');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_status');
            $table->foreign('id_status')->references('id')->on('order_statuses');
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
        Schema::dropIfExists('orders');
    }
};
