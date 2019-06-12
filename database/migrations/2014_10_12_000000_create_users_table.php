<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('User', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('UserName');
            $table->string('FirstName');
            $table->string('Name');
            $table->string('PhoneWork')->nullable();
            $table->string('PhoneHome')->nullable();
            $table->string('Mobile')->nullable();
            $table->string('Email')->unique();
            $table->string('Street')->nullable();
            $table->integer('PostalCode')->nullable();
            $table->string('City')->nullable();
            $table->string('GoogleId')->nullable();
            $table->timestamp('EmailVerifiedAt')->nullable();
            $table->string('Password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        /*
            FunctionId int
            RoleId int
            TypeAccountId int
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('User');
    }
}
