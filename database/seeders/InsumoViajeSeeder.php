<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Insumos_viaje;

class InsumoViajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Insumos_viaje::create([
            'viaje_id' => '4',
            'insumo_id' => '1',
        ]);
        Insumos_viaje::create([
            'viaje_id' => '5',
            'insumo_id' => '2',
        ]);
    }
}