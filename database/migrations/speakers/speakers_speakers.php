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
        Schema::create('speakers_speakers', function (Blueprint $table) {

            $table->id();
            $table->bigInteger('code')->unique()->nullable();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('short_desc_en');
            $table->text('short_desc_ar');
            $table->text('long_desc_en');
            $table->text('long_desc_ar');
            $table->string('image');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('website')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speakers_speakers');
    }
};
