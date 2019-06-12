<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Step', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Type');
            $table->string('Title');
            $table->integer('ContactIdSms')->unsigned()->nullable();
            $table->integer('ContactIdPhoneNumber')->unsigned()->nullable();
            $table->string('Image')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ContactIdSms')->references('Id')->on('User');
            $table->foreign('ContactIdPhoneNumber')->references('Id')->on('User');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Steps');
    }
}
