<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecondadminsTable extends Migration
{
   
    public function up()
    {
        
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',60);
            $table->string('username',100);
            $table->string('password');
            $table->boolean('status')->default(0);
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
        //
    }
}
