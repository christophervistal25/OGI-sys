<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_course', function (Blueprint $table) {
            $table->foreignId('student_id')->references('id')->on('students');
            $table->foreignId('course_id')->references('id')->on('courses');
            $table->enum('year_level', [1, 2, 3, 4, 5]);
            $table->enum('semester', [1, 2, 3]);
            $table->primary(['student_id', 'course_id', 'semester']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_course');
    }
}
