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
        Schema::create('events_events', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('image');
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('short_desc_en');
            $table->text('short_desc_ar');
            $table->text('long_desc_ar');
            $table->string('long_desc_en');
            $table->decimal('price');
            $table->string('date');
            $table->string('from_time');
            $table->string('to_time');
            $table->string('location');

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_events');
    }
};
