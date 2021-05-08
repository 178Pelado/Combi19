<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
        	'nombre_de_usuario' => 'felipe.mosqueira',
        	'contraseña' => '123456',
        ]);
        Admin::create([
        	'nombre_de_usuario' => 'benjamin.freccero',
        	'contraseña' => '123456',
        ]);
        Admin::create([
        	'nombre_de_usuario' => 'geronimo.vega',
        	'contraseña' => '123456',
        ]);
    }
}
