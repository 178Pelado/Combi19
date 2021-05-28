<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Insumos_pasaje;

class InsumoPasajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Insumos_pasaje::create([
        	'pasaje_id' => '1',
        	'insumo_id' => '1',
        	'cantidad' => '10',
            'precio_al_reservar' => '100.0'
        ]);
        Insumos_pasaje::create([
            'pasaje_id' => '2',
            'insumo_id' => '2',
            'cantidad' => '20',
            'precio_al_reservar' => '100.0'
        ]);
    }
}