@extends('layouts.app')

@section('title', 'Lista de insumos')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Lista de insumos total') }}</div>
				<div class="card-body">
					<table class="table table-bordered">
						@if($insumos[0] !== null)
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Descripción</th>
									<th>Cantidad</th>
									<th>Precio</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($insumos as $insumo)
								<tr>
									<td>{{$insumo->nombre}}</td>
									<td>{{$insumo->descripcion}}</td>
									<td>{{$insumo->cantidad}}</td>
									<td>{{$insumo->precio}}</td>
									<td>
										<a href="{{route('combi19.modificarInsumo', $insumo)}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
										<form action="{{route('combi19.eliminarInsumo', $insumo)}}" method="POST">
											@csrf
											@method('delete')
											<button class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></button>
										</form>
									</td>
									@endforeach
								</tr>
							</tbody>
						@else
							<h1>No hay insumos cargados</h1>
						@endif
					</table>
					<a href="{{route('combi19.altaInsumo')}}">Alta insumo</a>
					{{$insumos->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
