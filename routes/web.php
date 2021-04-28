<?php

use App\Http\Controllers\PasajeroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\iniciarSesionController;
use App\Http\Controllers\ChoferController;

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
