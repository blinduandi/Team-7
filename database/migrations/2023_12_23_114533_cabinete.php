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
        Schema::create('grupe', function (Blueprint $table) {
            $table->id();
            $table->string('specialty');
            $table->string('language');
            $table->unsignedInteger('number_pers');
            $table->unsignedBigInteger('subject_id');
            $table->timestamps();

            $table->foreign('subject_is')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupe');
    }
};
