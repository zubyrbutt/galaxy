<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMorefieldToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('department_id')->after('role_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->after('role_id')->nullable();
            $table->integer('designation_id')->after('role_id')->unsigned()->nullable();
            $table->foreign('designation_id')->references('id')->on('designations')->after('role_id')->nullable();
        });
    }
    
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('department_id');
            $table->dropColumn('designation_id');
        });
    }
}
