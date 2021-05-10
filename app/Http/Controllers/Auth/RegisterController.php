<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Pasajero;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      $dt = new Carbon();
      $before = $dt->subYears(18)->format("Y-m-d");
        return Validator::make($data, [
            'nombre' => 'required|alpha_spaces',
            'apellido' => 'required|alpha_spaces',
            'dni' => 'required|integer|gt:0',
            'email' => 'required|unique:pasajeros|email',
            'clave' => 'required|min:6',
            'fecha_nacimiento' => 'required|before_or_equal:' . $before,
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Pasajero::create([
          'nombre' => $data['nombre'],
          'apellido' => $data['apellido'],
          'dni' => $data['dni'],
          'email' => $data['email'],
          'contraseña' => $data['clave'],
          'fecha_de_nacimiento' => $data['fecha_nacimiento'],
        ]);
        return User::create([
            'name' => $data['nombre'],
            'email' => $data['email'],
            'tipo' => '3',
            'password' => Hash::make($data['clave']),
        ]);
    }
}
