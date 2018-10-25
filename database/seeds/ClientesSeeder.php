<?php

use Illuminate\Database\Seeder;
use App\Models\Clientes;

class ClientesSeeder extends Seeder
{
    public function run()
    {

        DB::table('usuarios')->delete();
        DB::table('clientes')->delete();

        $usuarios = factory(Clientes::class, 1000)->create();

    }
}