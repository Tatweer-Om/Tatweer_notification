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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable(); // Customer name
            $table->string('second_name')->nullable(); // Customer name
            $table->string('last_name')->nullable(); // Customer name
            $table->string('full_name')->nullable(); // Customer name
            $table->string('student_email')->nullable(); // Customer email (unique)
            $table->string('civil_number')->nullable(); // Phone number
            $table->string('student_number')->nullable(); // Phone number
            $table->tinyInteger('gender')->nullable()->comment('1 for male, 2 for female'); // Gender as integer
            $table->date('dob')->nullable(); // Date of birth (nullable)
            $table->longText('notes')->nullable(); // Address (optional)
            $table->integer('user_id')->nullable(); // Foreign key to users table (nullable)
            $table->string('added_by')->nullable(); // User who added the booking
            $table->string('updated_by')->nullable(); // User who updated the booking
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
