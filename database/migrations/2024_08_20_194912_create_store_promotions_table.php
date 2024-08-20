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
        Schema::create('store_promotions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('promotion_status')->default(1);
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('id_store');
            $table->unsignedBigInteger('id_promotion');
            $table->foreign('id_store')->references('id')->on('stores');
            $table->foreign('id_promotion')->references('id')->on('promotions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_promotions');
    }
};
