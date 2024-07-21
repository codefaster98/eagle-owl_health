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
        Schema::create('users_users', function (Blueprint $table) {

            $table->id();
            $table->string('code')->unique();
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->boolean('is_member')->default(false);
            $table->bigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('member_ship');
            $table->boolean('active')->default(false);
            $table->boolean('deleted');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_users');
    }
};
