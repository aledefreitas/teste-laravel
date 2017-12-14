<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Criamos a camada (A)ttribute do EAV, para evitar dados duplicados considerando que a única diferença
         *  é Nome, Sobrenome / Nome Fantasia, Razão Social
         */
        Schema::create('user_attributes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->increments('id');
            $table->string('attribute');
            $table->string('label');
        });

        // Forçamos o Seed dos dados default das labels de Attributes do EAV
        Artisan::call("db:seed", [
            '--class' => 'UserAttributesSeeder',
            '--force' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_attributes');
    }
}
