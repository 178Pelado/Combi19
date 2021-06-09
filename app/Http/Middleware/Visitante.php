<?php

namespace App\Http\Middleware;

//Necesitamos colocar esta ruta.
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;


class Visitante
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        switch(auth::user()->tipo){
           case('1'):
                return redirect('admin');
                break;
            case('2'):
                return redirect('chofer');
                break;
            case('3'):
                return redirect('pasajero');
                break;
            case('4'):
                return $next($request);
                break;
       }
    }
}
