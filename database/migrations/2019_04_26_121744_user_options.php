<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('User', function (Blueprint $table) {
            $table->integer('RoleId')->unsigned()->nullable();
            $table->integer('PositionId')->unsigned()->nullable();
            $table->integer('TypeAccountId')->unsigned()->nullable();

            $table->foreign('RoleId')->references('Id')->on('Role');
            $table->foreign('PositionId')->references('Id')->on('Position');
            $table->foreign('TypeAccountId')->references('Id')->on('TypeAccount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
