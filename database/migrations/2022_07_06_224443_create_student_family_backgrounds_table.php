<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFamilyBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_family_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('students');
            $table->string('mother_firstname');
            $table->string('mother_middlename')->default('')->nullable();
            $table->string('mother_lastname');
            $table->string('mother_contact_no');
            $table->string('father_firstname');
            $table->string('father_middlename')->default('')->nullabe();
            $table->string('father_lastname');
            $table->string('father_suffix')->default('*')->nullable();
            $table->string('father_contact_no');
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
        Schema::dropIfExists('student_family_backgrounds');
    }
}
