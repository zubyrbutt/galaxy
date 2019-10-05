<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalarystatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salarystatuses', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dated')->nullable();
            $table->text('reason')->nullable();
            $table->integer('salarysheet_id')->unsigned();
            $table->foreign('salarysheet_id')->references('id')->on('salarysheets');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('modified_by')->unsigned();
            $table->foreign('modified_by')->references('id')->on('users');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('salarystatuses');
    }
}
