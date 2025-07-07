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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('name'); // Team name
            $table->unsignedInteger('number_of_members');
            $table->string('type'); // Team type
            $table->text('features')->nullable(); // Team features
            $table->text('registration_reason')->nullable(); // Reason to register

            $table->string('profile')->nullable(); // Team profile image or file
            $table->string('profile_intro_file')->nullable(); // File path
            $table->string('declaration_file'); // Declaration PDF file

            // Leader info
            $table->string('leader_name');
            $table->string('leader_civil_id');
            $table->string('leader_phone');
            $table->string('leader_email');
            $table->string('leader_position')->nullable();
            $table->string('leader_company')->nullable();
            $table->string('leader_region')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
