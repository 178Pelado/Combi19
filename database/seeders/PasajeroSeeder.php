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
        	'dni' => '25123456',
        	'email' => 'pasajero@gmail.com',
        	'contraseña' => '123456',
        ]);
        Pasajero::create([
            'nombre' => 'Gerónimo',
            'apellido' => 'Vega',
            'dni' => '43194505',
            'email' => 'gerogv@gmail.com',
            'contraseña' => '123456',
        ]);
        Pasajero::create([
            'nombre' => 'Luis Miguel',
            'apellido' => 'Rodríguez',
            'dni' => '99999999',
            'email' => null,
            'contraseña' => null,
        ]);
    }
}