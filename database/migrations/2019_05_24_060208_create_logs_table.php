<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Log', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('UserName')->nullable();
            $table->string('Email')->nullable();
            $table->string('Role')->nullable();
            $table->string('ProcedureCode')->nullable();
            $table->string('ProcedureTitle')->nullable();
            $table->string('StepTitle')->nullable();
            $table->string('Action')->nullable();
            $table->string('CallingNumber')->nullable();
            $table->string('SendNumber')->nullable();
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
        Schema::dropIfExists('Log');
    }
}
