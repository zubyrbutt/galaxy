<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatedinfoToAttendancesheets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendancesheets', function (Blueprint $table) {
            $table->boolean('isupdated')->default(0);
            $table->integer('modifiedby')->nullable();
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
            $table->dropColumn('isupdated', 'modifiedby');
        });
    }
}
