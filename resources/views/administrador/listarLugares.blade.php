@extends('layouts.vistaAdministrador')

@section('title', 'Lista de lugares')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Lista de Lugares') }}</div>
				<div class="card-body">
					@csrf
					<ul>
						@foreach ($lugares as $lugar)
						<li>{{$lugar->nombre}}</li>
						@endforeach
					</ul>
					<a href="{{route('combi19.altaLugar')}}">Alta lugar</a>
					{{$lugares->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
