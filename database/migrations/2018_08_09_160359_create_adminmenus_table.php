<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminmenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminmenus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menutitle');
            $table->integer('parentid')->unsigned()->nullable();
            $table->foreign('parentid')->references('id')->on('adminmenus');
            $table->boolean('showinnav')->nullable();
            $table->boolean('setasdefault')->nullable();
            $table->string('iconclass')->nullable();
            $table->string('urllink')->nullable();
            $table->integer('displayorder')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('adminmenus');
    }
}
