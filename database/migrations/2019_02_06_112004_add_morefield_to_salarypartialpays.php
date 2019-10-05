<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMorefieldToSalarypartialpays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salarypartialpays', function (Blueprint $table) {
            $table->string('chequeno')->default(0)->nullable()->after('amountpaid');
            $table->integer('bank_id')->nullable()->after('amountpaid');
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->string('paymentmethod')->default(0)->after('amountpaid');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salarypartialpays', function (Blueprint $table) {
            $table->dropColumn('chequeno');
            $table->dropColumn('bank_id');
            $table->dropColumn('paymentmethod');
        });
    }
}
