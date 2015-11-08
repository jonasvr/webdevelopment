<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            //NAW
            $table->string('name');
            $table->string('surname');
            $table->string('street');
            $table->integer('nr');
            $table->string('additive')->nullable();
            $table->string('city');
            $table->integer('postalcode');
            $table->string('country');
            
            //login
            $table->string('loginname')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
            $table->string('email')->unique();

            $table->string('ip_address', 45);
            $table->softDeletes();
           
        });
        Schema::table('users', function ($table) {
        $table->integer('admin')->nullable();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }


}
