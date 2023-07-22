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
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->comment('Student_id = user_id');
            $table->integer('class_id')->nullable();
            $table->integer('year_id')->nullable();
            $table->bigInteger('assign_subject_id')->nullable();
            $table->string('id_number')->nullable();
            $table->integer('exam_type_id')->nullable();
            $table->double('mark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_marks');
    }
};
