<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentassignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('studentassignments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_name');
            $table->string('teacher_name')->nullable();;
            $table->string('assignment')->nullable();;
            $table->string('done_assignment');
            $table->string('course');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('studentassignments');
    }
}
