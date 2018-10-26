<?php

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesSeeder extends Seeder
{
    public function run()
    {

        DB::table('usuarios')->delete();
        DB::table('clientes')->delete();

        $usuarios = factory(Cliente::class, 1000)->create();

    }
}