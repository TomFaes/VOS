<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderToStep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Step', function (Blueprint $table) {
            $table->integer('ProcedureId')->unsigned()->nullable();
            $table->integer('Order')->unsigned()->nullable();
            $table->foreign('ProcedureId')->references('Id')->on('Procedure');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Step', function (Blueprint $table) {
            //$table->dropForeign('ProcedureId');
            //$table->dropColumn('ProcedureId');
            //$table->dropColumn('Order');
        });
    }
}
