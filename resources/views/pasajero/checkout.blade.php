@extends('layouts.app')

@section('title', 'Mi carrito')

@section('content')
<div class="container">
    <div class="row">
       <div class="col-sm-12 bg-light">
           @if (count(Cart::getContent()))
            <table class="table table-striped">
                <thead>
                    <th>NOMBRE</th>
                    <th>PRECIO(U)</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO(T)</th>
                </thead>
                <tbody>
                    <?php
                        $precioTotal = 0;
                    ?>
                    @foreach (Cart::getContent() as $item)
                        <tr>
                            <?php
                                $precioTotal = $precioTotal + $item->price * $item->quantity;
                            ?>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price * $item->quantity}}</td>
                            <td>
                                <form action="{{route('cart.removeitem')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="hidden" name='cantidad' value="{{$item->quantity}}">
                                    <button type="submit" class="btn btn-link btn-sm text-danger">x</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td>PRECIO TOTAL:</td>
                        <td>{{$precioTotal}}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            @else
                <h1>Carrito vacío</h1>
           @endif

       </div>

    </div>
</div>
@endsection
