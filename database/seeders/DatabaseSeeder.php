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
        $this->call(CombiSeeder::class);
        $this->call(PasajeroSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TarjetaSeeder::class);
        $this->call(SuscripcionSeeder::class);
        $this->call(LugarSeeder::class);
        $this->call(RutaSeeder::class);
        $this->call(InsumoSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(ViajeSeeder::class);
        $this->call(PasajeSeeder::class);
        $this->call(InsumoViajeSeeder::class);
        $this->call(InsumoPasajeSeeder::class);
    }
}
