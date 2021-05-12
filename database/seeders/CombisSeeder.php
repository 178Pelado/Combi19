<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Combi;

class CombisSeeder extends Seeder
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
        	'cantidad_asientos' => '11',
        	'tipo' => 'Super Cómoda',
        	'chofer_id' => '1',
        ]);
        Combi::create([
            'patente' => 'AAA 111',
            'modelo' => 'Mercedes',
            'cantidad_asientos' => '11',
            'tipo' => 'Super Cómoda',
            'chofer_id' => '2',
        ]);
    }
}
