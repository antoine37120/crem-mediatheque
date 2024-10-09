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
        
        Schema::table('audio_items', function (Blueprint $table) {
            $table->string('link')->nullable();
            $table->string('original_name')->nullable();
        });
        Schema::table('geographical_areas', function (Blueprint $table) {
            $table->string('region_code')->nullable();
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
