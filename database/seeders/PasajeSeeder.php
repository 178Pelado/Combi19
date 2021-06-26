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
            'tarjeta_id' => '1',
            'precio_viaje' => '100.0',
            'precio' => '90.0',
        	'estado' => '1',
            'estado_covid' => '0',
            'estado_pago' => '0',
            'comprador_id' => '1',
        ]);
        Pasaje::create([
            'viaje_id' => '1',
            'pasajero_id' => '4',
            'tarjeta_id' => '1',
            'precio_viaje' => '100.0',
            'precio' => '90.0',
            'estado' => '1',
            'estado_covid' => '0',
            'estado_pago' => '0',
            'comprador_id' => '1',
        ]);
        Pasaje::create([
            'viaje_id' => '1',
            'pasajero_id' => '3',
            'tarjeta_id' => '1',
            'precio_viaje' => '100.0',
            'precio' => '90.0',
            'estado' => '1',
            'estado_covid' => '0',
            'estado_pago' => '0',
            'comprador_id' => '1',
        ]);
        Pasaje::create([
            'viaje_id' => '2',
            'pasajero_id' => '1',
            'tarjeta_id' => '1',
            'precio_viaje' => '200.0',
            'precio' => '180.0',
            'estado' => '1',
            'estado_covid' => '0',
            'estado_pago' => '0',
            'comprador_id' => '1',
        ]);
        Pasaje::create([
            'viaje_id' => '3',
            'pasajero_id' => '1',
            'tarjeta_id' => '1',
            'precio_viaje' => '300.0',
            'precio' => '270.0',
            'estado' => '1',
            'estado_covid' => '0',
            'estado_pago' => '0',
            'comprador_id' => '1',
        ]);
        Pasaje::create([
            'viaje_id' => '4',
            'pasajero_id' => '1',
            'tarjeta_id' => '1',
            'precio_viaje' => '400.0',
            'precio' => '360.0',
            'estado' => '1',
            'estado_covid' => '0',
            'estado_pago' => '0',
            'comprador_id' => '1',
        ]);
        Pasaje::create([
            'viaje_id' => '6',
            'pasajero_id' => '2',
            'tarjeta_id' => '1',
            'precio_viaje' => '600.0',
            'precio' => '540.0',
            'estado' => '1',
            'estado_covid' => '0',
            'estado_pago' => '0',
            'comprador_id' => '2',
        ]);
        Pasaje::create([
            'viaje_id' => '6',
            'pasajero_id' => '3',
            'tarjeta_id' => '1',
            'precio_viaje' => '600.0',
            'precio' => '540.0',
            'estado' => '1',
            'estado_covid' => '0',
            'estado_pago' => '0',
            'comprador_id' => '3',
        ]);
    }
}