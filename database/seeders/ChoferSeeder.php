<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chofer;

class ChoferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chofer::create([
        	'nombre' => 'Felipe',
        	'apellido' => 'Mosqueira Jurado',
        	'telefono' => '123456',
        	'email' => 'fm@gmail.com',
        	'contraseña' => '123456',
        ]);
    }
}
