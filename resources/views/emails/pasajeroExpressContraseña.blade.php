<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Comprobante de registro</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<h1>Comprobante de registro {{$pasajero->nombre}}</h1>
	<p>Muchas gracias por confiar en combi19. A continuación se detallarán tus datos.</p>
	<div class="container">
		<div class="table-responsive">
				 <table class="table align-middle">
					<thead>
						<th>NOMBRE</th>
						<th>APELLIDO</th>
						<th>DNI</th>
						<th>EMAIL</th>
						<th>CONTRASEÑA</th>
					</thead>
					<tbody>
						<tr>
							<td>{{$pasajero->nombre}}</td>
							<td>{{$pasajero->apellido}}</td>
							<td>{{$pasajero->dni}}</td>
							<td>{{$pasajero->email}}</td>
							<td>{{$pasajero->contraseña}}</td>
						</tr>
					</tbody>
				</table>
		</div>
	</div>
</body>
</html>
