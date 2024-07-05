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
        Schema::create('audio_item_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('audio_item_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->fullText()->nullable();
            $table->longText('description')->fullText()->nullable();
        
            $table->unique(['audio_item_id', 'locale']);
            $table->foreign('audio_item_id')->references('id')->on('audio_items')->onDelete('cascade');
        });
        Schema::create('geographical_area_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('geographical_area_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->fullText()->nullable();
        
            $table->unique(['geographical_area_id', 'locale'], 'unique_geographical_area_id_local');
            $table->foreign('geographical_area_id')->references('id')->on('geographical_areas')->onDelete('cascade');
        });
        Schema::create('playlist_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('playlist_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->fullText()->nullable();
            $table->longText('description')->fullText()->nullable();
        
            $table->unique(['playlist_id', 'locale']);
            $table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('cascade');
        });

        Schema::table('audio_items', function (Blueprint $table) {
            $table->dropColumn(['name', 'description']);
        });
        Schema::table('geographical_areas', function (Blueprint $table) {
            $table->dropColumn(['name']);
        });
        Schema::table('playlists', function (Blueprint $table) {
            $table->dropColumn(['name', 'description']);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
