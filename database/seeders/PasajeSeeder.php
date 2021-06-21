<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasaje;

class PasajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pasaje::create([
        	'viaje_id' => '4',
        	'pasajero_id' => '1',
            'precio_viaje' => '100.0',
            'precio' => '290.0',
        	'estado' => '3',
            'estado_covid' => '0',
            'comprador_id' => '1',
        ]);
        Pasaje::create([
            'viaje_id' => '4',
            'pasajero_id' => '4',
            'precio_viaje' => '100.0',
            'precio' => '90.0',
            'estado' => '3',
            'estado_covid' => '0',
            'comprador_id' => '1',
        ]);
        Pasaje::create([
            'viaje_id' => '6',
            'pasajero_id' => '1',
            'precio_viaje' => '100.0',
            'precio' => '90.0',
            'estado' => '3',
            'estado_covid' => '0',
            'comprador_id' => '1',
        ]);
    }
}