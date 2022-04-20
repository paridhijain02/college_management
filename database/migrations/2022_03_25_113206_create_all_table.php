<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',60);
            $table->string('username',100);
            $table->string('password');
            $table->enum('gender', ["M","F","O"])->nullable();
            $table->string('course',50);
            $table->string('year',20)->nullable();
            $table->boolean('status')->default(0);
            $table->string('role',20);
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
        Schema::dropIfExists('all');
    }
}
