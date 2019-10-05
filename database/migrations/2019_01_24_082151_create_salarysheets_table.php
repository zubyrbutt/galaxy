<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalarysheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salarysheets', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dated');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');           
            $table->integer('tardies')->default(0);
            $table->integer('shortleaves')->default(0);
            $table->integer('absents')->default(0);
            $table->integer('paidleaves')->default(0);
            $table->integer('unpaidleaves')->default(0);
            $table->integer('presents')->default(0);
            $table->integer('totaldays')->default(0);
            $table->integer('deductedays')->default(0);
            $table->double('basicsalary', 8, 2)->default(0);
            $table->double('earnedsalary', 8, 2)->default(0);
            $table->double('grosssalary', 8, 2)->default(0);
            $table->double('otherdeductions', 8, 2)->default(0);
            $table->double('additions', 8, 2)->default(0);
            $table->double('salarydeductions', 8, 2)->default(0);
            $table->double('perdaysalary', 8, 2)->default(0);
            $table->double('netsalary', 8, 2)->default(0);
            $table->string('status')->nullable();
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('modified_by')->unsigned();
            $table->foreign('modified_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salarysheets');
    }
}
