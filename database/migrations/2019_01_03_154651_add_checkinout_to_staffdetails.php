<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckinoutToStaffdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staffdetails', function (Blueprint $table) {
            $table->time('starttime')->after('attendancecheck')->nulable();
            $table->time('endtime')->after('attendancecheck')->nulable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staffdetails', function (Blueprint $table) {
            $table->dropColumn('starttime');
            $table->dropColumn('endtime');
        });
    }
}
