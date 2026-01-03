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
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->date('meal_date');
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner']);
            $table->string('main_menu');
            $table->string('soup');
            $table->string('sub_menu')->nullable();
            $table->string('fruits');
            $table->timestamps();

            $table->unique(['meal_date', 'meal_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
