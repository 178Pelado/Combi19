<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chofer;

class ChoferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chofer::create([
        	'patente' => 'AAA 222',
        	'modelo' => 'Mercedes',
        	'telefono' => '123456',
        	'email' => 'fm@gmail.com',
        	'contraseña' => '123456',
        ]);
    }
}
