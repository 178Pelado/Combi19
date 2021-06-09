<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarjeta;

class TarjetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarjeta::create([
        	'numero' => '2222222222222222',
        	'codigo' => '000',
        	'fecha_de_vencimiento' => '2021-06-01',
        ]);
    }
}