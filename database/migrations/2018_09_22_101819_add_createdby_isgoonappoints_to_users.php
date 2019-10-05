<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedbyIsgoonappointsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('isGoOnAppoints')->default(false)->after('remember_token')->nullable();
            $table->integer('createdby')->unsigned()->nullable();
            $table->foreign('createdby')->references('id')->on('users');
            $table->integer('updatedby')->unsigned()->nullable();
            $table->foreign('updatedby')->references('id')->on('users');
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
            $table->dropColumn('isGoOnAppoints');
            $table->dropColumn('createdby');
            $table->dropColumn('updatedby');
        });
    }
}
