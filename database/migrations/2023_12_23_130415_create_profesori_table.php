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
        Schema::create('profesori', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->unsignedBigInteger('subiect_id');
            $table->foreign('subiect_id')->references('id')->on('subiecte')->onDelete('cascade');;
            $table->unsignedBigInteger('tip_perechi_id');
            $table->foreign('tip_perechi_id')->references('id')->on('types')->onDelete('cascade');;
            $table->boolean('mon_per_1');
            $table->boolean('mon_per_2');
            $table->boolean('mon_per_3');
            $table->boolean('mon_per_4');
            $table->boolean('mon_per_5');
            $table->boolean('mon_per_6');
            $table->boolean('mon_per_7');
            $table->boolean('tue_per_1');            
            $table->boolean('tue_per_2');
            $table->boolean('tue_per_3');
            $table->boolean('tue_per_4');
            $table->boolean('tue_per_5');
            $table->boolean('tue_per_6');
            $table->boolean('tue_per_7');
            $table->boolean('wed_per_1');
            $table->boolean('wed_per_2');
            $table->boolean('wed_per_3');
            $table->boolean('wed_per_4');
            $table->boolean('wed_per_5');
            $table->boolean('wed_per_6');
            $table->boolean('wed_per_7');
            $table->boolean('thu_per_1');
            $table->boolean('thu_per_2');
            $table->boolean('thu_per_3');
            $table->boolean('thu_per_4');
            $table->boolean('thu_per_5');
            $table->boolean('thu_per_6');
            $table->boolean('thu_per_7');
            $table->boolean('fri_per_1');
            $table->boolean('fri_per_2');
            $table->boolean('fri_per_3');
            $table->boolean('fri_per_4');
            $table->boolean('fri_per_5');
            $table->boolean('fri_per_6');
            $table->boolean('fri_per_7');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesori');
    }
};
