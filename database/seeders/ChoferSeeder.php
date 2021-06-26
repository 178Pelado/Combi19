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
        	'nombre' => 'Michael',
        	'apellido' => 'Schumacher',
        	'telefono' => '123456',
        	'email' => 'miky@gmail.com',
        	'contraseña' => '123456',
        ]);
        Chofer::create([
            'nombre' => 'Dominic',
            'apellido' => 'Toretto',
            'telefono' => '123456',
            'email' => 'dominic@gmail.com',
            'contraseña' => '12345678',
        ]);
        Chofer::create([
            'nombre' => 'Oscar',
            'apellido' => 'Suarez',
            'telefono' => '123456',
            'email' => 'oscar@gmail.com',   
            'contraseña' => '12345678',
        ]);
        Chofer::create([
            'nombre' => 'Pepe',
            'apellido' => 'Sancho',
            'telefono' => '123456',
            'email' => 'pepeS@gmail.com',   
            'contraseña' => '12345678',
        ]);
    }
}
