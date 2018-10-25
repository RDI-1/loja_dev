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
        if (!Schema::hasTable('usuarios')) {
            Schema::create('usuarios', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nome', 254);
                $table->string('cpf', 100)->nullable()->unique();
                $table->string('cnpj', 100)->nullable()->unique();
                $table->string('email', 200)->unique();
                $table->string('celular', 80)->nullable()->unique();
                $table->string('telefone', 80)->nullable()->unique();
                $table->string('senha', 200);
                $table->timestamps();
                $table->softDeletes();
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
        if (Schema::hasTable('usuarios')) {

            Schema::drop('usuarios');

        }
    }
}
