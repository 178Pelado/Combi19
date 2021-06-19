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
        	'combi_id' => '1',
            'chofer_id' => '1',
        	'ruta_id' => '1',
        	'precio' => '100.000',
            'fecha' => '2021-06-15 18:00:00',
            'estado' => '1',
        ]);
        Viaje::create([
        	'combi_id' => '3',
            'chofer_id' => '3',
        	'ruta_id' => '2',
        	'precio' => '250.000',
            'fecha' => '2021-06-20 15:00:00',
            'estado' => '1',
        ]);
        Viaje::create([
            'combi_id' => '2',
            'chofer_id' => '2',
            'ruta_id' => '3',
            'precio' => '1000.000',
            'fecha' => '2021-07-31 16:00:00',
            'estado' => '1',
        ]);
        Viaje::create([
            'combi_id' => '2',
            'chofer_id' => '2',
            'ruta_id' => '3',
            'precio' => '100.000',
            'fecha' => '2021-05-31 16:00:00',
            'estado' => '3',
        ]);
        Viaje::create([
            'combi_id' => '2',
            'chofer_id' => '2',
            'ruta_id' => '4',
            'precio' => '100.000',
            'fecha' => '2021-06-17 16:00:00',
            'estado' => '1',
        ]);
        Viaje::create([
            'combi_id' => '2',
            'chofer_id' => '2',
            'ruta_id' => '4',
            'precio' => '100.000',
            'fecha' => '2021-06-02 16:00:00',
            'estado' => '3',
        ]);
    }
}