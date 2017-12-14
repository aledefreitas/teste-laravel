<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Criamos a camada (V)alue do EAV, para evitar dados duplicados considerando que a única diferença
         *  é Nome, Sobrenome / Nome Fantasia, Razão Social
         */
        Schema::create('user_values', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->integer('user_attribute_id')->unsigned();

            $table->string("value");

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_attribute_id')->references('id')->on('user_attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_values');
    }
}
