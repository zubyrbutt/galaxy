<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('projectName');
            $table->text('projectDescription');
            $table->tinyInteger('projectType')->default(1)->comment('1=Fixed or 2=Monthly');
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->integer('lead_id')->unsigned();
            $table->foreign('lead_id')->references('id')->on('leads')->nullable()->comment('Lead Id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->nullable()->comment('Customer Id');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->nullable()->comment('Created by User');
            $table->integer('modified_by')->unsigned();
            $table->foreign('modified_by')->references('id')->on('users')->nullable()->comment('Modified by User');
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
        Schema::dropIfExists('projects');
    }
}
