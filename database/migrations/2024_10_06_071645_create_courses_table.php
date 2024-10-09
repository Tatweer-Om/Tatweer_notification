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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name')->nullable(); // Customer name
            $table->string('teacher_id')->nullable(); // Customer name
            $table->date('start_date')->nullable(); // Customer email (unique)
            $table->date('end_date')->nullable(); // Customer email (unique)
            $table->time('start_time')->nullable(); // Phone number
            $table->time('end_time')->nullable(); // Phone number
            $table->string('course_price')->nullable(); // Phone number
            $table->longText('notes')->nullable(); // Address (optional)
            $table->integer('user_id')->nullable(); // Foreign key to users table (nullable)
            $table->string('added_by')->nullable(); // User who added the booking
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
