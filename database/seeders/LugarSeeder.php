<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lugar;

class LugarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lugar::create([
        	'nombre' => 'La Plata',
        ]);

        Lugar::create([
            'nombre' => 'Saladillo',
        ]);
        Lugar::create([
            'nombre' => 'Roque Pérez',
        ]);
        Lugar::create([
            'nombre' => 'Bahía Blanca',
        ]);
        Lugar::create([
            'nombre' => 'Lanús',
        ]);
    }
}