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
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->timestamps();
        });

        
        Schema::create('cms_page_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('cms_page_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name')->fullText()->nullable();
            $table->longText('content')->fullText()->nullable();
        
            $table->unique(['cms_page_id', 'locale']);
            $table->foreign('cms_page_id')->references('id')->on('cms_pages')->onDelete('cascade');
        });

        
        Schema::table('cms_pages', function (Blueprint $table) {
            $table->index(['slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_pages');
    }
};
