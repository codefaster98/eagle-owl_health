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
        Schema::create('memberships_member_ship_users', function (Blueprint $table) {

            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->foreignId('memberships_plan_id')->nullable()->references('id')->on('memberships_member_ship')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->references('id')->on('users_users')->constrained()->cascadeOnDelete();
            $table->string("start_date");
            $table->string("end_date");

        });
        Schema::enableForeignKeyConstraints();
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('memberships_member_ship_users');
        Schema::enableForeignKeyConstraints();
    }
};
