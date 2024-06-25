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
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('picture');
            $table->foreignId('type_id')->index();
            $table->timestamps();
        });

        Schema::create('audio_item_playlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audio_item_id')->index();
            $table->foreignId('playlist_id')->index();
            $table->foreignId('sort')->nullable()->index();
        });

        Schema::table('playlists', function (Blueprint $table) {
            $table->fullText(['name', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audio_item_playlist');
        Schema::dropIfExists('playlists');
    }
};
