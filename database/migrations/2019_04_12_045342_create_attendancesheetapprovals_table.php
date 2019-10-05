<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesheetapprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendancesheetapprovals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('dated');
            $table->string('dayname')->nullable();
            $table->timestamp('attendancedate')->nullable();
            $table->time('checkin')->nullable();
            $table->time('checkout')->nullable();
            $table->time('breakout')->nullable();
            $table->time('breakin')->nullable();
            $table->integer('tardies')->default(0);
            $table->integer('shortleaves')->default(0);
            $table->integer('workedhours')->default(0);
            $table->string('checkoutfound')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('paid')->nullable();
            $table->string('status')->nullable();
            $table->boolean('isupdated')->default(0);
            $table->integer('modifiedby')->nullable();
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
        Schema::dropIfExists('attendancesheetapprovals');
    }
}
