<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotaltardiesandshortleavesToAttendancesheets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendancesheets', function (Blueprint $table) {
            $table->integer('tardies')->after('breakin')->default(0);
            $table->integer('shortleaves')->after('breakin')->default(0);

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
            $table->dropColumn('tardies');
            $table->dropColumn('shortleaves');
        });
    }
}
