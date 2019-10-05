<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYccleadstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yccleadstatuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('note')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('ycclead_id')->unsigned();
            $table->foreign('ycclead_id')->references('id')->on('yccleads');
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
        Schema::dropIfExists('yccleadstatuses');
    }
}
