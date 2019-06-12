<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Organisation', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Name');
            $table->string('Street')->nullable();
            $table->integer('PostalCode')->nullable();
            $table->string('City')->nullable();
            $table->string('SecretariaatTel')->nullable();
            $table->string('ClbTel')->nullable();
            $table->integer('PreventieAdviseurId')->unsigned()->nullable();
            $table->decimal('Latitude', 18, 14)->nullable();
            $table->decimal('Longitude', 18, 14)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('PreventieAdviseurId')->references('Id')->on('User');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Organisation');
    }
}
