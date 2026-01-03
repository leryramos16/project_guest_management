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
        Schema::table('guest_meals', function (Blueprint $table) {
            $table->date('meal_date')->nullable()->after('meal_id');
            $table->string('meal_type')->nullable()->after('meal_date');

            $table->string('main_menu')->nullable();
            $table->string('soup')->nullable();
            $table->string('sub_menu')->nullable();
            $table->string('fruits')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guest_meals', function (Blueprint $table) {
            //
        });
    }
};
