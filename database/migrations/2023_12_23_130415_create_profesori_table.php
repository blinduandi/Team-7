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
        Schema::create('profesors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');;
            $table->unsignedBigInteger('type_class_id');
            $table->foreign('type_class_id')->references('id')->on('types')->onDelete('cascade');;
            $table->boolean('mon_class_1');
            $table->boolean('mon_class_2');
            $table->boolean('mon_class_3');
            $table->boolean('mon_class_4');
            $table->boolean('mon_class_5');
            $table->boolean('mon_class_6');
            $table->boolean('mon_class_7');
            $table->boolean('tue_class_1');            
            $table->boolean('tue_class_2');
            $table->boolean('tue_class_3');
            $table->boolean('tue_class_4');
            $table->boolean('tue_class_5');
            $table->boolean('tue_class_6');
            $table->boolean('tue_class_7');
            $table->boolean('wed_class_1');
            $table->boolean('wed_class_2');
            $table->boolean('wed_class_3');
            $table->boolean('wed_class_4');
            $table->boolean('wed_class_5');
            $table->boolean('wed_class_6');
            $table->boolean('wed_class_7');
            $table->boolean('thu_class_1');
            $table->boolean('thu_class_2');
            $table->boolean('thu_class_3');
            $table->boolean('thu_class_4');
            $table->boolean('thu_class_5');
            $table->boolean('thu_class_6');
            $table->boolean('thu_class_7');
            $table->boolean('fri_class_1');
            $table->boolean('fri_class_2');
            $table->boolean('fri_class_3');
            $table->boolean('fri_class_4');
            $table->boolean('fri_class_5');
            $table->boolean('fri_class_6');
            $table->boolean('fri_class_7');
            $table->boolean('sat_class_1');
            $table->boolean('sat_class_2');
            $table->boolean('sat_class_3');
            $table->boolean('sat_class_4');
            $table->boolean('sat_class_5');
            $table->boolean('sat_class_6');
            $table->boolean('sat_class_7');
            
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
