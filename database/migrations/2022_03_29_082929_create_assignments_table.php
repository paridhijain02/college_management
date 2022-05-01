<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assignment');
            $table->string('username');
            $table->string('course');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
