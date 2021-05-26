<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
        	'nombre' => 'Pendiente',
        ]);
        Estado::create([
            'nombre' => 'En curso',
        ]);
        Estado::create([
            'nombre' => 'Finalizado',
        ]);
        Estado::create([
            'nombre' => 'Suspendido',
        ]);
        Estado::create([
            'nombre' => 'Cancelado por el usuario',
        ]);
        Estado::create([
            'nombre' => 'Cancelado por covid positivo',
        ]);   
    }
}