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
        Schema::create('events_event_speakers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('events_id');
            $table->foreign('events_id')->references('id')->on('events');
            $table->bigInteger('speakers_id');
            $table->foreign('speakers_id')->references('id')->on('speakers');


        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_event_speakers');
    }
};
