<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Models\Insumo;
use App\Models\Viaje;
use App\Models\Combi;
use App\Models\Pasajero;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
  /**
  * Register any application services.
  *
  * @return void
  */
  public function register()
  {
    //
  }

  /**
  * Bootstrap any application services.
  *
  * @return void
  */
  public function boot()
  {
    //Add this custom validation rule.
    Validator::extend('alpha_spaces', function ($attribute, $value) {

      // This will only accept alpha and spaces.
      // If you want to accept hyphens use: /^[\pL\s-]+$/u.
      return preg_match('/^[\pL\s]+$/u', $value);

    });

    Validator::extend('alpha_num_spaces', function ($attribute, $value) {

      // This will only accept alpha_num and spaces.
      // If you want to accept hyphens use: /^[\pL\s-]+$/u.
      return preg_match('/^[a-zA-Z0-9\s]+$/', $value);

    });

    Validator::extend('nombre_descripcion', function ($attribute, $value, $parameters) {
      $insumo = Insumo::where('nombre', '=', $parameters[0])->where('descripcion', '=', $value)->get()->first();
      if(empty($insumo)){
        return true;
      }
      else{
        return false;
      }
    });

    Validator::extend('nombre_descripcion2', function ($attribute, $value, $parameters) {
      $insumo = Insumo::where('nombre', '=', $value)->where('descripcion', '=', $parameters[0])->where('id', '<>', $parameters[1])->get()->first();
      if(empty($insumo)){
        return true;
      }
      else{
        return false;
      }
    });

    // Está al pedo
    // Validator::extend('nombre_descripcion_upd', function ($attribute, $value, $parameters) {
    //   $aux = Insumo::where('id', '=', $parameters[0])->get()->first();
    //   $insumo = Insumo::where('id', '<>', $parameters[0])->where('nombre', '=', $parameters[1])->where('descripcion', '=', $value)->get()->first();
    //   if(empty($insumo)){
    //     return true;
    //   }
    //   else{
    //     return false;
    //   }
    // });

    Validator::extend('viaje_distinto_fecha', function ($attribute, $value, $parameters) {
      $fecha = Carbon::parse($value);
      $antes = $fecha->subHours(6)->format('Y-m-d H:i:s');
      $despues = $fecha->addHours(12)->format('Y-m-d H:i:s');
      $viaje = Viaje::where('combi_id', '=', $parameters[0])->whereBetween('fecha', [$antes, $despues])->where('id', '<>', $parameters[1])->get();
      if(count($viaje) == 0){
        return true;
      }
      else{
        return false;
      }
    });

    Validator::extend('es_contraseña_actual', function ($attribute, $value, $parameters) {
      $pasajero = Pasajero::where('id', '=', $parameters[1])->where('contraseña', '=', $parameters[0])->get();
      if(count($pasajero) == 0){
        return false;
      }
      else{
        return true;
      }
    });

  }
}
