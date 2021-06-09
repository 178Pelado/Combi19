<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruta;

class RutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ruta::create([
        	'origen_id' => '1',
            'destino_id' => '2',
            'descripcion' => 'Por RP6 y RN205',
            'distancia_km' => '205.6',
        ]);
        Ruta::create([
            'origen_id' => '3',
            'destino_id' => '1',
            'descripcion' => 'Por RN205',
            'distancia_km' => '158.5',
        ]);
        Ruta::create([
            'origen_id' => '1',
            'destino_id' => '4',
            'descripcion' => 'Por RN3 y RP51',
            'distancia_km' => '626.8',
        ]);
        Ruta::create([
            'origen_id' => '2',
            'destino_id' => '5',
            'descripcion' => 'Por RN205',
            'distancia_km' => '179.5',
        ]);
    }
}