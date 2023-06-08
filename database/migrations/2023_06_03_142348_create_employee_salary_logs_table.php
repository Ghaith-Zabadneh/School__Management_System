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
        Schema::create('employee_salary_logs', function (Blueprint $table) {
            $table->id();
            $table->double('employee_id')->comment('employee_id = user_id');
            $table->double('previous_salary')->nullable();
            $table->double('present_salary')->nullable();
            $table->double('increment_salary')->nullable();
            $table->date('effective_salary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salary_logs');
    }
};
