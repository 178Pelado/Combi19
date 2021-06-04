<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasajero;

class PasajeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pasajero::create([
        	'nombre' => 'Felipe',
        	'apellido' => 'Mosqueira Jurado',
        	'dni' => '123456',
        	'email' => 'fm@gmail.com',
        	'contraseña' => '123456',
        ]);
        Pasajero::create([
        	'nombre' => 'pasajero',
        	'apellido' => 'Mosqueira Jurado',
        	'dni' => '123456',
        	'email' => 'pasajero@gmail.com',
        	'contraseña' => '12345678',
        ]);
    }
}
