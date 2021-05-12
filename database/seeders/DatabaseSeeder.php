<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ChoferSeeder::class);
        $this->call(CombisSeeder::class);
        $this->call(PasajeroSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LugarSeeder::class);
        $this->call(RutaSeeder::class);
        $this->call(InsumoSeeder::class);
        $this->call(ViajeSeeder::class);
    }
}
