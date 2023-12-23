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
            $table->string('specialitate');
            $table->unsignedBigInteger('limba_id');
            $table->foreign('limba_id')->references('id')->on('limbi')->onDelete('cascade');;
            $table->integer('numar_pers');
            $table->unsignedBigInteger('subiect_id');
            $table->foreign('subiect_id')->references('id')->on('subiecte')->onDelete('cascade');;
            $table->timestamps();
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
