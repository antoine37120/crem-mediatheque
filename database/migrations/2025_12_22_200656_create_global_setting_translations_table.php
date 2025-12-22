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
        Schema::create('global_setting_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('global_setting_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->longText('value')->nullable();
            
            $table->unique(['global_setting_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_setting_translations');
    }
};
