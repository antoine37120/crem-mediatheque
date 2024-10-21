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
        //Select years on search
        Schema::create('year_options', function (Blueprint $table) {
            $table->id();
            $table->integer('from')->unsigned()->nullable();
            $table->integer('to')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('year_option_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('year_option_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
        
            $table->unique(['year_option_id', 'locale']);
            $table->foreign('year_option_id')->references('id')->on('year_options')->onDelete('cascade');
        });


        //Select duration on search
        Schema::create('duration_options', function (Blueprint $table) {
            $table->id();
            $table->integer('from')->unsigned()->nullable();
            $table->integer('to')->unsigned()->nullable();
            $table->timestamps();
        });

        
        Schema::create('duration_option_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('duration_option_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->nullable();
        
            $table->unique(['duration_option_id', 'locale']);
            $table->foreign('duration_option_id')->references('id')->on('duration_options')->onDelete('cascade');
        });
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
