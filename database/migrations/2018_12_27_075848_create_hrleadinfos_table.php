<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrleadinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrleadinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('positionsought')->nullable();
            $table->string('desiresalary')->nullable();
            $table->string('employed')->nullable();
            $table->timestamp('startingdate')->nullable();
            $table->string('shift')->nullable();
            $table->string('qualification')->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('paddress')->nullable();
            $table->integer('hrlead_id')->unsigned();
            $table->foreign('hrlead_id')->references('id')->on('hrleads');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('hrleadinfos');
    }
}
