<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwnsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awnsers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('awnser');
            $table->integer('shifting');
            $table->integer('FK_inquiry');
            $table->integer('FK_user');
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
        Schema::drop('awnsers');
    }
}
