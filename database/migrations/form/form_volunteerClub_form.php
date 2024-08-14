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
        Schema::create('form_volunteerClub_form', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('phone');
            $table->string('whatsapp');
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('password');
            $table->string('education')->nullable();
            $table->string('language')->nullable();
            $table->string('social_media_links')->nullable();
            // Volunteer Interest checkboxes
            $table->boolean('interest_administration')->default(false);
            $table->boolean('interest_field_work')->default(false);
            $table->boolean('interest_campaigning')->default(false);
            $table->boolean('interest_volunteer_coordination')->default(false);
            $table->boolean('interest_media_maintenance_gardening')->default(false);
            $table->boolean('interest_health_wellness_disability')->default(false);
            $table->boolean('interest_festivals_culture')->default(false);
            $table->boolean('interest_other')->default(false);

            // Other fields
            $table->string('talent')->nullable();
            $table->enum('time_available', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'])->default('Wednesday')->nullable();
            $table->text('skills')->nullable();
            $table->text('other_notes')->nullable();

            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('form_volunteerClub_form');
        Schema::enableForeignKeyConstraints();
    }
};
