<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('businessName');
            $table->string('businessNature');
            $table->text('description')->nullable();
            $table->text('weblink')->nullable();
            $table->text('fblink')->nullable()->comment('Facebook');
            $table->integer('fblike')->nullable();
            $table->text('twlink')->nullable()->comment('Twitter');
            $table->integer('twfollwer')->nullable();
            $table->text('lilink')->nullable()->comment('Linkedin');
            $table->integer('livisitor')->nullable();
            $table->text('inlink')->nullable()->comment('Instagram');
            $table->text('incfollower')->nullable();
			$table->boolean('solser')->default(false)->nullable()->comment('Solutions and Services');
			$table->boolean('testimonials')->default(false)->nullable();
            $table->boolean('company_pro')->default(false)->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            $table->boolean('status')->default(true);

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
        Schema::dropIfExists('leads');
    }
}
