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
        	'estado' => '1',
        ]);
    }
}