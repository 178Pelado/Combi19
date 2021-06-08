@extends('layouts.app')

@section('title', 'Mi carrito')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12 bg-light">
      @if(Session::has('messageNO'))
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('messageNO')}}. <a href="{{route('combi19.modificarTarjeta', Auth::user()->email)}}">Modificar tarjeta</a>
      </div>
      @elseif(Session::has('messageSI'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('messageSI')}}
      </div>
      @endif
      <table class="table table-striped">
        @if (count(Cart::getContent()))
        <thead>
          <th>VIAJE</th>
          <th>PASAJERO</th>
          <th>PRECIO VIAJE</th>
          <th>PRECIO(T)</th>
          <th>ACCIONES</th>
        </thead>
        <tbody>
          <?php
          $precioTotal = 0;
          ?>
          @foreach (Cart::getContent() as $item)
          <tr>
            <?php
            $precioTotal = $precioTotal + $item->price * $item->quantity;
            $pasaje = App\Models\Pasaje::find($item->id);
            ?>
            <td>{{$item->name}}</td>
            <td>{{$pasaje->nombrePasajero()}}</td>
            <td>{{$item->price}}</td>
            <td>{{$pasaje->precio}}</td>
            <td>
              <form action="{{route('cart.removeitem')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}">
                <input type="hidden" name='cantidad' value="{{$item->quantity}}">
                <button type="submit" class="btn btn-link btn-sm text-danger"><i class="material-icons">&#xE5C9;</i></button>
                <button type="button" data-toggle="modal" data-target="#exampleModal{{$pasaje->id}}" class="btn btn-link btn-sm"><i class="material-icons">&#xE417;</i></button>
              </form>

              <!-- The Modal -->

              <div class="modal" id="exampleModal{{$pasaje->id}}">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Lista de insumos pasaje</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-body">
                              <table class="table table-bordered">
                                @if(count($pasaje->insumos_asociados()) != 0)
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
                                  @foreach ($pasaje->insumos_pasaje() as $insumo)
                                  <tr>
                                    <td>{{$insumo->insumo->nombre}}</td>
                                    <td>{{$insumo->insumo->descripcion}}</td>
                                    <td>{{$insumo->cantidad}}</td>
                                    <td>{{$insumo->precio_al_reservar}}</td>
                                    <td>
                                      <a href="{{route('combi19.eliminarReservaInsumo', $insumo->id)}}" class="text-danger"><i class="material-icons">&#xE5C9;</i></a>
                                    </td>
                                    @endforeach
                                  </tr>
                                </tbody>
                                @else
                                <h1>No hay insumos cargados</h1>
                                @endif
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer btn-group" role="group">
                        <a href="{{route('combi19.listarInsumosViaje', [$pasaje->viaje_id, $pasaje->pasajero_id])}}" class="btn btn-info">
                          {{ __('Agregar insumos') }}
                        </a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                          {{ __('Cancelar') }}
                        </button>
                      </div>
                      @endforeach
                    </tr>
                  </tbody>
                  </table>
                  <form action="{{route('combi19.pagarPasaje')}}" class="formulario-pagar" method="GET">
                    @csrf
                    <button class="btn btn-info" data-toggle="tooltip">Pagar</button>
                  </form>
                  @else
                  <h1>Carrito vacío</h1>
                  @endif
              </div>
            </div>
          </div>

<script>
$('.formulario-pagar').submit(function(event){
  event.preventDefault();

  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: '¿Estás seguro?',
    text: "¡Si cancela un pasaje dentro de las 48hs previas a viajar, solo se le reembolsará el 50%!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '¡Si, pagar!',
    cancelButtonText: '¡No, cancelar!',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      // swalWithBootstrapButtons.fire(
      //   '¡Eliminado!',
      //   '',
      //   'success'
      // )
      this.submit();
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      // swalWithBootstrapButtons.fire(
      //   'Cancelado',
      //   '',
      //   'error'
      // )
    }
  })

});
</script>

          @endsection