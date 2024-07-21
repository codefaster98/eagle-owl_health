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
        Schema::create('events_event_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('events_id');
            $table->foreign('events_id')->references('id')->on('events');
            $table->bigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->string('payment_id')->nullable();
            $table->json('payment_details')->nullable();
            $table->string('time');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_event_users');
    }
};
