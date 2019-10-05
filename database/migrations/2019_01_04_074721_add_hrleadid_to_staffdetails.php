<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHrleadidToStaffdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staffdetails', function (Blueprint $table) {
            $table->integer('hrlead_id')->unsigned()->nullable()->after('starttime');
            $table->foreign('hrlead_id')->references('id')->on('hrleads');
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
            $table->dropColumn('hrlead_id');
        });
    }
}
