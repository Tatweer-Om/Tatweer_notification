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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('course_name')->nullable(); // Customer name
            $table->string('course_id')->nullable(); // Customer name
            $table->string('student_name')->nullable(); // Customer name
            $table->string('student_id')->nullable(); // Customer name
            $table->string('course_price')->nullable(); // Address (optional)
            $table->string('offer_id')->nullable(); // Address (optional)
            $table->string('offer_name')->nullable(); // Address (optional)
            $table->string('discounted_price')->nullable(); // Address (optional)
            $table->string('offer_discount')->nullable(); // Address (optional)
            $table->string('new_discount')->nullable(); // Address (optional)
            $table->string('total_discount')->nullable(); // Phone number
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
        Schema::dropIfExists('enrollments');
    }
};
