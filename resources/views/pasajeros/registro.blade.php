@extends('layouts.plantilla')

@section('title', 'Registro pasajeros')

@section('content')
	<h1> Registro </h1>
	<form action="{{route('combi19.store')}}" method="POST">
		
		@csrf

		<label>
			Nombre:
			<br>
			<input type="text" name="nombre">
		</label>

		<br>

		<label>
			Apellido:
			<br>
			<input type="text" name="apellido">
		</label>

		<br>

		<label>
			DNI:
			<br>
			<input type="text" name="dni">
		</label>

		<br>

		<label>
			Email:
			<br>
			<input type="email" name="email">
		</label>

		<br>

		<label>
			Clave:
			<br>
			<input type="password" name="clave">
		</label>

		<br>

		<label>
			Fecha de nacimiento:
			<br>
			<input type="date" name="fecha_nacimiento">
		</label>

		<br>

		<button type="submit">Registrarse</button>
	</form>
@endsection