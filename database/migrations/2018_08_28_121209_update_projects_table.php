<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function(Blueprint $table) {
            $table->boolean('isSMM')->default(0);
            $table->boolean('isiOS')->default(0);
            $table->boolean('isAndroid')->default(0);
            $table->boolean('isWeb')->default(0);
            $table->boolean('isCustom')->default(0);
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function(Blueprint $table) {
            $table->dropColumn('isSMM');
            $table->dropColumn('isiOS');
            $table->dropColumn('isAndroid');
            $table->dropColumn('isWeb');
            $table->dropColumn('isCustom');
        });
    }
}
