<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'admin',
        	'email' => 'admin@gmail.com',
          'password' => Hash::make('12345678'),
          'tipo' => '1',
          'codigo' => 'adm1',
        ]);
        User::create([
        	'name' => 'chofer',
        	'email' => 'chofer@gmail.com',
          'password' => Hash::make('12345678'),
          'tipo' => '2',
          'codigo' => 'adm2',
        ]);
        User::create([
        	'name' => 'pasajero',
        	'email' => 'pasajero@gmail.com',
          'password' => Hash::make('12345678'),
          'tipo' => '3',
          'codigo' => 'adm3',
        ]);
    }
}
