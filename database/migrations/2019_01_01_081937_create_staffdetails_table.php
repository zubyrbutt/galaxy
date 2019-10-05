<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('cstreetaddress')->nullable();
            $table->string('cstreetaddress2')->nullable();
            $table->string('ccity')->nullable();
            $table->string('pstreetaddress')->nullable();
            $table->string('pstreetaddress2')->nullable();
            $table->string('pcity')->nullable();
            $table->string('gaurdianname')->nullable();
            $table->string('gaurdianrelation')->nullable();
            $table->integer('gaurdiancontact')->nullable();
            $table->integer('landline')->nullable();
            $table->integer('phonenumber')->unique()->nullable();
            $table->string('bloodgroup')->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('cnic')->unique()->nullable();
            $table->string('passportno')->unique()->nullable();
            $table->integer('attendanceid')->nullable();
            $table->integer('extension')->nullable();
            $table->integer('ccmsid')->nullable();
            $table->string('skypeid')->nullable();
            $table->string('shift')->nullable();
            $table->integer('latecomming')->nullable();
            $table->boolean('attendancecheck')->default(true);
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
        Schema::dropIfExists('staffdetails');
    }
}
