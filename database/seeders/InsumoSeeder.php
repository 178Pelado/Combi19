<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Insumo;

class InsumoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Insumo::create([
        	'nombre' => 'Coca Cola',
        	'descripcion' => '3l',
        	'cantidad' => '100',
        	'precio' => '100',
        ]);

        Insumo::create([
            'nombre' => 'Coca Cola',
            'descripcion' => '2l',
            'cantidad' => '100',
            'precio' => '100',
        ]);

        Insumo::create([
            'nombre' => 'Papas Lays',
            'descripcion' => '150gr',
            'cantidad' => '100',
            'precio' => '100',
        ]);

        Insumo::create([
            'nombre' => 'Papas Lays',
            'descripcion' => '125gr',
            'cantidad' => '100',
            'precio' => '100',
        ]);
    }
}