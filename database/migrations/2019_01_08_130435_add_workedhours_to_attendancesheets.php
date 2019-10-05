<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkedhoursToAttendancesheets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendancesheets', function (Blueprint $table) {
            $table->integer('workedhours')->after('tardies')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendancesheets', function (Blueprint $table) {
            $table->dropColumn('workedhours');
        });
    }
}
