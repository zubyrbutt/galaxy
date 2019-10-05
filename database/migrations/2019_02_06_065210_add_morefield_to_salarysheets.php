<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMorefieldToSalarysheets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salarysheets', function (Blueprint $table) {
            $table->double('absentfine', 8, 2)->default(0)->after('otherdeductions');
            $table->double('totaldeductions', 8, 2)->default(0)->after('salarydeductions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salarysheets', function (Blueprint $table) {
            $table->dropColumn('absentfine');
            $table->dropColumn('totaldeductions');
        });
    }
}
