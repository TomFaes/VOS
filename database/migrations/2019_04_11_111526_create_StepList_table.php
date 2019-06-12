<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStepListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StepList', function (Blueprint $table) {
            $table->increments('Id');

            $table->integer('StepId')->unsigned();
            $table->string('Title')->nullable();
            $table->integer('Order')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('StepId')->references('Id')->on('Step');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('StepList');
    }
}
