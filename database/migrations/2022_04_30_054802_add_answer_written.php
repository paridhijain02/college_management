<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnswerWritten extends Migration
{
    public function up()
    {
        Schema::table('assignments', function (Blueprint $table) {
                $table->integer('number_answer_solved')->default(0)->after('course');
        });
    }
    public function down()
    {
        Schema::table('assignments', function (Blueprint $table) {
            //
        });
    }
}
