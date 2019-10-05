<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDialedcallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialedcalls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('businessname')->nullable();
            $table->string('businesstype')->nullable();
            $table->string('website')->nullable();
            $table->string('contactperson')->nullable();
            $table->string('designation')->nullable();
            $table->string('email')->unique()->nullable();
            $table->integer('phone')->unique()->nullable();
            $table->string('status')->nullable();
            $table->text('note')->nullable();
            $table->integer('dialed_by')->unsigned();
            $table->foreign('dialed_by')->references('id')->on('users');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('dialedcalls');
    }
}
