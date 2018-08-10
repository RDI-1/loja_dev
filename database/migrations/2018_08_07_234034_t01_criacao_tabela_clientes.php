<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class T01CriacaoTabelaClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('adm_clientes') == false) {
            Schema::create('adm_clientes', function (Blueprint $table) {

                $table->increments('pk_id_adm_cliente');

                $table->unsignedInteger('fk_id_adm_pessoa_usuario');

                $table->foreign('fk_id_adm_pessoa_usuario')
                    ->references('pk_id_adm_pessoa_usuario')
                    ->on('adm_pessoas_usuarios');

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
        if (Schema::hasTable('adm_clientes')) {

            Schema::drop('adm_clientes');

        }
    }
}
