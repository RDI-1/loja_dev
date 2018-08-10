<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class T01CriacaoTabelaUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('adm_pessoas_usuarios') == false) {
            Schema::create('adm_pessoas_usuarios', function (Blueprint $table) {
                $table->increments('pk_id_adm_pessoa_usuario');
                $table->string('nome');
                $table->string('cpf')->unique();
                $table->string('email')->unique();
                $table->string('senha');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('adm_pessoas_usuarios')) {

            Schema::drop('adm_pessoas_usuarios');

        }
    }
}
