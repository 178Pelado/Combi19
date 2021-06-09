<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Combi;

class CombiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Combi::create([
        	'patente' => 'AAA 222',
        	'modelo' => 'Mercedes',
        	'cantidad_asientos' => '25',
        	'tipo' => 'Cómoda',
        	'chofer_id' => '1',
        ]);
        Combi::create([
            'patente' => 'AAA 111',
            'modelo' => 'Mercedes',
            'cantidad_asientos' => '25',
            'tipo' => 'Super Cómoda',
            'chofer_id' => '2',
        ]);
        Combi::create([
            'patente' => 'AAA 333',
            'modelo' => 'Mercedes',
            'cantidad_asientos' => '2',
            'tipo' => 'Super Cómoda',
            'chofer_id' => '3',
        ]);
    }
}
