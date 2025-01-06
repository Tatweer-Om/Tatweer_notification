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
            $table->string('service_ids')->nullable(); // Customer name
            $table->string('customer_id')->nullable(); // Customer name
            $table->string('purchase_date')->nullable(); // Customer name
            $table->string('system_urls')->nullable(); // Customer name
            $table->string('renewl')->nullable(); // Address (optional)
            $table->string('renewl_date')->nullable(); // Address (optional)
            $table->string('renewl_cost')->nullable(); // Address (optional)
            $table->string('service_cost')->nullable(); // Address (optional)

            $table->string('notes')->nullable(); // Address (optional)

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
