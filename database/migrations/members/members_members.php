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
        Schema::create('members_members', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('name_en');
            $table->string('name_ar');
            $table->text('desc_en');
            $table->text('desc_ar');
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
        Schema::dropIfExists('members_members');
    }
};
