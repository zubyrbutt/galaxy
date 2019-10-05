<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJoiningdateandfilenoToStaffdetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staffdetails', function (Blueprint $table) {
            $table->date('joiningdate')->nullable();
            $table->string('fileno')->nullable();
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
            $table->dropColumn('joiningdate','fileno');
        });
    }
}
