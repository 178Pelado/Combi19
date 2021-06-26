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
            'chofer_id' => '2',
            'ruta_id' => '1',
            'precio' => '100.000',
            'fecha' => '2021-07-01 8:40:00',
            'estado' => '1',
        ]);
        Viaje::create([
            'combi_id' => '2',
            'chofer_id' => '2',
            'ruta_id' => '2',
            'precio' => '200.000',
            'fecha' => '2021-07-14 16:00:00',
            'estado' => '1',
        ]);
        Viaje::create([
            'combi_id' => '2',
            'chofer_id' => '2',
            'ruta_id' => '3',
            'precio' => '300.000',
            'fecha' => '2021-07-17 16:00:00',
            'estado' => '1',
        ]);
        Viaje::create([
            'combi_id' => '2',
            'chofer_id' => '2',
            'ruta_id' => '4',
            'precio' => '400.000',
            'fecha' => '2021-07-31 16:00:00',
            'estado' => '1',
        ]);
        Viaje::create([
            'combi_id' => '2',
            'chofer_id' => '2',
            'ruta_id' => '2',
            'precio' => '500.000',
            'fecha' => '2021-07-07 16:00:00',
            'estado' => '1',
        ]);
        Viaje::create([
            'combi_id' => '2',
            'chofer_id' => '2',
            'ruta_id' => '2',
            'precio' => '600.000',
            'fecha' => '2021-07-22 16:00:00',
            'estado' => '1',
        ]);
    }
}