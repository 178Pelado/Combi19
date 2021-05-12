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
    }
}