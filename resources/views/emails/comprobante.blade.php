<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Comprobante</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<h1>Comprobante de pago de {{Auth::user()->name}}</h1>
	<p>Muchas gracias por confiar en combi19. A continuación se detallará su compra.</p>
	<table class="table table-striped">
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
</body>
</html>