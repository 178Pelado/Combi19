<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Comprobante</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<h1>Comprobante de pago de {{Auth::user()->name}}</h1>
	<p>Muchas gracias por confiar en combi19. A continuación se detallará su compra.</p>
	<div class="container">
		<div class="table-responsive">
				 <table class="table align-middle">
					<thead>
						<th>VIAJE</th>
						<th>PASAJERO</th>
						<th>PRECIO VIAJE</th>
						<th>PRECIO(T)</th>
						<th>INSUMOS</th>
					</thead>
					<tbody>
						<?php
							$precioTotal = 0;
						?>
						@foreach ($pasajes as $item)
						<tr>
							<?php
								$pasaje = App\Models\Pasaje::find($item->id);;
								$insumos_pasaje = $pasaje->insumos_pasaje();
								$precioTotal+= $pasaje->precio;
							?>
							<td>{{$item->name}}</td>
							<td>{{$pasaje->nombrePasajero()}}</td>
							<td>{{$item->price}}</td>
							<td>{{$pasaje->precio}}</td>
							<td>
								@foreach ($insumos_pasaje as $insumo_pasaje)
									{{$insumo_pasaje->insumo->nombre}} (x{{$insumo_pasaje->cantidad}} - ${{$insumo_pasaje->precio_al_reservar}})<br>
								@endforeach
							</td>
						@endforeach
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td>TOTAL</td>
							<td>{{$precioTotal}}</td>
							<td></td>
						</tr>
					</tbody>
				</table>
		</div>
	</div>
</body>
</html>
