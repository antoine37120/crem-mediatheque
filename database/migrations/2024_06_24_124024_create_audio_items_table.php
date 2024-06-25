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
        Schema::create('geographical_areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('audio_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('duration');
            $table->year('year');
            $table->foreignId('geographical_area_id')->index();
            $table->longText('description')->nullable();
            $table->string('file');
            $table->tinyText('interpreters')->nullable();
            $table->string('collector');
            $table->string('picture')->nullable();
            $table->timestamps();
        });

        Schema::table('audio_items', function (Blueprint $table) {
            $table->index(['duration', 'year']);
            $table->fullText(['name', 'description']);
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geographical_areas');
        Schema::dropIfExists('audio_items');
    }
};
