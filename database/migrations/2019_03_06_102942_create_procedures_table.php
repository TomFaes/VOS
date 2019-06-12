<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Procedure', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Code');
            $table->string('Title');
            $table->text('Description')->nullable();
            $table->string('Heading');
            $table->string('Image')->nullable();
            $table->integer('ProcedureTypeId')->unsigned();
            $table->integer('RoleId')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ProcedureTypeId')->references('id')->on('ProcedureType');
            $table->foreign('RoleId')->references('id')->on('Role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Procedure');
    }
}
