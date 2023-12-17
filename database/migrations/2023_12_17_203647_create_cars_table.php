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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('model_id')->index()->comment('ID модели');
            $table->foreign('model_id')->references('id')->on('car_models')->onDelete('cascade');
            $table->unsignedSmallInteger('year_production')->index()->nullable()->comment('Год выпуска');
            $table->unsignedInteger('mileage')->nullable()->comment('Пробег');
            $table->unsignedBigInteger('color_id')->index()->nullable()->comment('ID цвета');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');
            $table->unsignedBigInteger('user_id')->index()->nullable()->comment('ID пользователя');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
