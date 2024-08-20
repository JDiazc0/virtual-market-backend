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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_status')->default(1);
            $table->unsignedBigInteger('user_type');
            $table->string('phone')->unique();
            $table->mediumInteger('temporal_code')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->foreign('user_type')->references('id')->on('user_types');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
