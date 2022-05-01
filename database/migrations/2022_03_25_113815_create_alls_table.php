<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllsTable extends Migration
{
    public function up()
    {
        Schema::create('alls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',60)->nullable();
            $table->string('username',100);
            $table->string('password');
            $table->enum('gender', ["M","F","O"])->nullable();
            $table->string('course',50)->nullable();
            $table->string('year',20)->nullable();
            $table->boolean('status')->default(0);
            $table->string('role',20);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('alls');
    }
}
