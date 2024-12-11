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
        Schema::create('geographical_area_continents', function (Blueprint $table) {
            $table->id();
            $table->string('continent_code');
            $table->timestamps();
        });

                
        Schema::create('geographical_area_continent_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('geographical_area_continent_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->fullText()->nullable();
        
            $table->unique(['geographical_area_continent_id', 'locale'], 'geo_continent_local_unique' );
            $table->foreign('geographical_area_continent_id', 'foreign_geographical_area_continent_id')->references('id')->on('geographical_area_continents')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geographical_area_continents');
    }
};
