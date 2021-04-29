<?php

use App\Http\Controllers\PasajeroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\iniciarSesionController;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\CombiController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\ViajeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class);

Route::get('combi19/registro', [PasajeroController::class, 'registro'])->name('combi19.registro');

Route::post('combi19/store', [PasajeroController::class, 'store'])->name('combi19.store');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('combi19/iniciarSesion', [iniciarSesionController::class, 'iniciarSesion'])->name('combi19.iniciarSesion');

Route::get('combi19/registroChofer', [ChoferController::class, 'registroChofer'])->name('combi19.registroChofer');
Route::post('combi19/storeChofer', [ChoferController::class, 'storeChofer'])->name('combi19.storeChofer');

Route::get('combi19/altaCombi', [CombiController::class, 'altaCombi'])->name('combi19.altaCombi');
Route::post('combi19/storeCombi', [CombiController::class, 'storeCombi'])->name('combi19.storeCombi');

Route::get('combi19/altaInsumo', [InsumoController::class, 'altaInsumo'])->name('combi19.altaInsumo');
Route::post('combi19/storeInsumo', [InsumoController::class, 'storeInsumo'])->name('combi19.storeInsumo');

Route::get('combi19/altaLugar', [LugarController::class, 'altaLugar'])->name('combi19.altaLugar');
Route::post('combi19/storeLugar', [LugarController::class, 'storeLugar'])->name('combi19.storeLugar');

Route::get('combi19/altaRuta', [RutaController::class, 'altaRuta'])->name('combi19.altaRuta');
Route::post('combi19/storeRuta', [RutaController::class, 'storeRuta'])->name('combi19.storeRuta');

Route::get('combi19/altaViaje', [ViajeController::class, 'altaViaje'])->name('combi19.altaViaje');
Route::post('combi19/storeViaje', [ViajeController::class, 'storeViaje'])->name('combi19.storeViaje');
