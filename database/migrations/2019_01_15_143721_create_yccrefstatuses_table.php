<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYccrefstatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yccrefstatuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('note')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('yccref_id')->unsigned();
            $table->foreign('yccref_id')->references('id')->on('yccrefs');
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
        Schema::dropIfExists('yccrefstatuses');
    }
}
