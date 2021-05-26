<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Viaje;

class ViajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Viaje::create([
        	'combi_id' => '2',
        	'ruta_id' => '1',
        	'precio' => '10.000',
            'fecha' => '2021-05-14 18:00:00',
            'estado' => '1',
        ]);
    }
}