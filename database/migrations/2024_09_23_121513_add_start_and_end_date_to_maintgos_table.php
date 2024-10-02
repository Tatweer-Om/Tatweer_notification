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
        Schema::table('maintgos', function (Blueprint $table) {
            $table->date('start_date')->nullable(); // Booking number
            $table->date('end_date')->nullable(); // Booking number
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maintgos', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'end_date']);
        });
    }
};
