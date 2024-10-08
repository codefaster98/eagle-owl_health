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
        Schema::disableForeignKeyConstraints();
        Schema::create('events_events', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('code')->unique();
            $table->string('image');
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('short_desc_en');
            $table->text('short_desc_ar');
            $table->longText('long_desc_ar');
            $table->longText('long_desc_en');
            $table->decimal('price');
            $table->decimal('price_ar');
            $table->string('date');
            $table->string('date_details');
            $table->string('from_time');
            $table->string('to_time');
            $table->string('location');
            $table->string('date_ar');
            $table->string('date_details_ar');
            $table->string('from_time_ar');
            $table->string('to_time_ar');
            $table->string('location_ar');
        });
        Schema::enableForeignKeyConstraints();
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('events_events');
        Schema::enableForeignKeyConstraints();
    }
};
