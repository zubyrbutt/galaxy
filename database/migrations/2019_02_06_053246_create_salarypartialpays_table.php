<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalarypartialpaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salarypartialpays', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dated')->nullable();
            $table->text('description')->nullable();
            $table->double('amountpaid', 8, 2)->default(0);
            $table->integer('salarysheet_id')->unsigned();
            $table->foreign('salarysheet_id')->references('id')->on('salarysheets');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('modified_by')->unsigned();
            $table->foreign('modified_by')->references('id')->on('users');
            $table->string('status')->default('Approved');
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
        Schema::dropIfExists('salarypartialpays');
    }
}
