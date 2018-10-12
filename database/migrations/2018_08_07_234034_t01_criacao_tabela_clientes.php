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
        if (!Schema::hasTable('clientes')) {
            Schema::create('clientes', function (Blueprint $table) {

                $table->increments('pk_id_adm_cliente');

                $table->unsignedInteger('fk_id_adm_pessoa_usuario');

                $table->foreign('fk_id_adm_pessoa_usuario')
                    ->references('pk_id_adm_pessoa_usuario')
                    ->on('usuarios');

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
        if (Schema::hasTable('clientes')) {

            Schema::drop('clientes');

        }
    }
}
