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
        Schema::create('events_event_users', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->foreignId('events_id')->nullable()->references('id')->on('events_events')->constrained()->cascadeOnDelete();
            $table->foreignId('users_id')->nullable()->references('id')->on('users_users')->constrained()->cascadeOnDelete();

            $table->string('payment_id')->nullable();
            $table->json('payment_details')->nullable();
            $table->string('time');
        });
        Schema::enableForeignKeyConstraints();
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('events_event_users');
        Schema::enableForeignKeyConstraints();
    }
};
