<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShowinsalaryToStaffdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staffdetails', function (Blueprint $table) {
            $table->boolean('showinsalary')->default(1); // Show=1 or Not Show=0
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
            $table->dropColumn('showinsalary');
        });
    }
}
