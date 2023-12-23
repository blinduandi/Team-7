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
        Schema::create('subiecte', function (Blueprint $table) {
            $table->id();
            $table->string('unitate_curs');
            $table->integer('teorie');
            $table->integer('practica');
            $table->integer('lab');
            $table->string('total');
            $table->integer('anul');
            $table->integer('semestru');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subiecte');
    }
};
