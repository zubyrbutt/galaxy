<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemarksToAttendancesheets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendancesheets', function (Blueprint $table) {
            $table->string('remarks')->nullable()->after('status');
            $table->string('dayname')->nullable()->after('dated');
            $table->integer('paid')->nullable()->after('status');

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
            $table->dropColumn('remarks');
            $table->dropColumn('dayname');
            $table->dropColumn('paid');
        });
    }
}
