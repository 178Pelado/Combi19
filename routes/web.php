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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Chofer1Controller;
use App\Http\Controllers\Pasajero1Controller;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\HomeVisitanteController;

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
Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
Route::get('combi19/registro', [PasajeroController::class, 'registro'])->name('combi19.registro');

Route::post('combi19/store', [PasajeroController::class, 'store'])->name('combi19.store');

Route::get('combi19/iniciarSesion', [iniciarSesionController::class, 'iniciarSesion'])->name('combi19.iniciarSesion');

Route::get('combi19/registroChofer', [ChoferController::class, 'registroChofer'])->name('combi19.registroChofer');
Route::post('combi19/storeChofer', [ChoferController::class, 'storeChofer'])->name('combi19.storeChofer');
Route::get('combi19/listarChoferes', [ChoferController::class, 'listarChoferes'])->name('combi19.listarChoferes');
Route::delete('combi19/eliminarChofer{chofer}', [ChoferController::class, 'eliminarChofer'])->name('combi19.eliminarChofer');
Route::get('combi19/modificarChofer{chofer}', [ChoferController::class, 'modificarChofer'])->name('combi19.modificarChofer');
Route::put('combi19/updateChofer{chofer}', [ChoferController::class, 'updateChofer'])->name('combi19.updateChofer');

Route::get('combi19/altaCombi', [CombiController::class, 'altaCombi'])->name('combi19.altaCombi');
Route::post('combi19/storeCombi', [CombiController::class, 'storeCombi'])->name('combi19.storeCombi');
//Route::get('combi19/listarCombis', [CombiController::class, 'listarCombis'])->middleware('can:combi19.listarCombis')->name('combi19.listarCombis');
Route::get('combi19/listarCombis', [CombiController::class, 'listarCombis'])->name('combi19.listarCombis');
Route::delete('combi19/eliminarCombi{combi}', [CombiController::class, 'eliminarCombi'])->name('combi19.eliminarCombi');
Route::get('combi19/modificarCombi{combi}', [CombiController::class, 'modificarCombi'])->name('combi19.modificarCombi');
Route::put('combi19/updateCombi{combi}', [CombiController::class, 'updateCombi'])->name('combi19.updateCombi');

Route::get('combi19/altaInsumo', [InsumoController::class, 'altaInsumo'])->name('combi19.altaInsumo');
Route::post('combi19/storeInsumo', [InsumoController::class, 'storeInsumo'])->name('combi19.storeInsumo');
Route::get('combi19/listarInsumosTotal', [InsumoController::class, 'listarInsumosTotal'])->name('combi19.listarInsumosTotal');
Route::delete('combi19/eliminarInsumo{insumo}', [InsumoController::class, 'eliminarInsumo'])->name('combi19.eliminarInsumo');
Route::get('combi19/modificarInsumo{insumo}', [InsumoController::class, 'modificarInsumo'])->name('combi19.modificarInsumo');
Route::put('combi19/updateInsumo{insumo}', [InsumoController::class, 'updateInsumo'])->name('combi19.updateInsumo');

Route::get('combi19/altaLugar', [LugarController::class, 'altaLugar'])->name('combi19.altaLugar');
Route::post('combi19/storeLugar', [LugarController::class, 'storeLugar'])->name('combi19.storeLugar');
Route::get('combi19/listarLugares', [LugarController::class, 'listarLugares'])->name('combi19.listarLugares');
Route::delete('combi19/eliminarLugar{lugar}', [LugarController::class, 'eliminarLugar'])->name('combi19.eliminarLugar');
Route::get('combi19/modificarLugar{lugar}', [LugarController::class, 'modificarLugar'])->name('combi19.modificarLugar');
Route::put('combi19/updateLugar{lugar}', [LugarController::class, 'updateLugar'])->name('combi19.updateLugar');

Route::get('combi19/altaRuta', [RutaController::class, 'altaRuta'])->name('combi19.altaRuta');
Route::post('combi19/storeRuta', [RutaController::class, 'storeRuta'])->name('combi19.storeRuta');
Route::get('combi19/listarRutas', [RutaController::class, 'listarRutas'])->name('combi19.listarRutas');
Route::delete('combi19/eliminarRuta{ruta}', [RutaController::class, 'eliminarRuta'])->name('combi19.eliminarRuta');
Route::get('combi19/modificarRuta{ruta}', [RutaController::class, 'modificarRuta'])->name('combi19.modificarRuta');
Route::get('combi19/modificarRutaConLugar/{ruta}/{lugar?}', [RutaController::class, 'modificarRutaConLugar'])->name('combi19.modificarRutaConLugar');
Route::put('combi19/updateRuta{ruta}', [RutaController::class, 'updateRuta'])->name('combi19.updateRuta');

Route::get('combi19/altaViaje', [ViajeController::class, 'altaViaje'])->name('combi19.altaViaje');
Route::post('combi19/storeViaje', [ViajeController::class, 'storeViaje'])->name('combi19.storeViaje');
Route::get('combi19/listarViajes', [ViajeController::class, 'listarViajes'])->name('combi19.listarViajes');
Route::delete('combi19/eliminarViaje{viaje}', [ViajeController::class, 'eliminarViaje'])->name('combi19.eliminarViaje');
Route::get('combi19/modificarViaje{viaje}', [ViajeController::class, 'modificarViaje'])->name('combi19.modificarViaje');
Route::put('combi19/updateViaje{viaje}', [ViajeController::class, 'updateViaje'])->name('combi19.updateViaje');
});
Route::group(['middleware' => 'pasajero', 'prefix' => 'pasajero', 'namespace' => 'Pasajero'], function () {
Route::get('combi19/modificarDatosDeCuentaPasajero{pasajero}', [PasajeroController::class, 'modificarDatosDeCuentaPasajero'])->name('combi19.modificarDatosDeCuentaPasajero');
Route::put('combi19/updatePasajero{pasajero}', [PasajeroController::class, 'updatePasajero'])->name('combi19.updatePasajero');
Route::get('combi19/suscripcion{pasajero}', [PasajeroController::class, 'suscripcion'])->name('combi19.suscripcion');
Route::post('combi19/storeSuscripcion{pasajero}', [PasajeroController::class, 'storeSuscripcion'])->name('combi19.storeSuscripcion');
Route::get('combi19/modificarTarjeta{pasajero}', [PasajeroController::class, 'modificarTarjeta'])->name('combi19.modificarTarjeta');
Route::put('combi19/updateTarjeta{pasajero}', [PasajeroController::class, 'updateTarjeta'])->name('combi19.updateTarjeta');
Route::delete('combi19/eliminarSuscripcion{pasajero}', [PasajeroController::class, 'eliminarSuscripcion'])->name('combi19.eliminarSuscripcion');
Route::get('combi19/perfilDePasajero{pasajero}', [PasajeroController::class, 'perfilDePasajero'])->name('combi19.perfilDePasajero');
Route::get('combi19/misViajes{pasajero}', [PasajeroController::class, 'misViajes'])->name('combi19.misViajes');
Route::get('combi19/realizarComentario', [PasajeroController::class, 'realizarComentario'])->name('combi19.realizarComentario');
Route::post('combi19/storeComentario/{viaje}/{pasajero}', [PasajeroController::class, 'storeComentario'])->name('combi19.storeComentario');
});
Route::get('/buscarViaje', [PasajeroController::class, 'buscarViaje'])->name('buscarViaje');
Route::post('/buscarViajeConDatos', [PasajeroController::class, 'buscarViajeConDatos'])->name('buscarViajeConDatos');


Route::get('homeGeneral', [HomeVisitanteController::class, 'homeGeneral'])->name('homeGeneral');
Route::resource('/admin', AdminController::class);
Route::resource('/chofer', Chofer1Controller::class);
Route::resource('/pasajero', Pasajero1Controller::class);
Route::resource('/visitante', VisitanteController::class);

Auth::routes();

Route::get('combi19/home', [HomeController::class, 'index'])->name('home');
