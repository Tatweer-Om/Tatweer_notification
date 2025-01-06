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
        Schema::create('rene_histories', function (Blueprint $table) {
            $table->id();
            $table->string('sub_id')->nullable();
            $table->string('old_renewl_date')->nullable();
            $table->string('new_renewl_date')->nullable();
            $table->string('renewl_cost')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rene_histories');
    }
};
