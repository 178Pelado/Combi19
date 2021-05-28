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
        	'viaje_id' => '1',
        	'pasajero_id' => '1',
            'precio_viaje' => '100.0',
            'precio' => '990.0',
        	'estado' => '3',
        ]);
        Pasaje::create([
        	'viaje_id' => '2',
        	'pasajero_id' => '1',
            'precio_viaje' => '250.0',
            'precio' => '2025.0',
        	'estado' => '1',
        ]);
    }
}