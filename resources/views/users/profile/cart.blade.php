@extends('layouts.main')

@section('title', 'Mi carrito')

@section('content')
  <a class="btn btn-warning float-start flex-fill btn-volver" href="{{ url('/mi-perfil/' . $user->user_id) }}">Volver</a>

  <h2 class="mb-4 cart-title">Mi carrito</h2>

  <table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th class="text-center" scope="col">Nombre</th>
            <th class="text-center" scope="col">Precio</th>
            <th class="text-center" scope="col">Cantidad</th>
            <th class="text-center" scope="col">Subtotal</th>
            <th class="text-center" scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $cart->products as $product )
            <tr>
                <td class="text-center align-middle">{{ $product->name }}</td>
                <td class="text-center align-middle">{{ $product->price }}</td>
                <td class="text-center align-middle">{{ $product->pivot->quantity }}</td>
                <td class="text-center align-middle">${{ $product->pivot->subtotal / 100}}</td>
                <td class="acciones">
                  <form method="POST" action="{{ route('profile.cart.add', ['userId' => Auth::user()->user_id, 'productId' => $product->product_id]) }}">                
                    @csrf
                    <button class="btn btn-success" type="submit" >Sumar</button>
                  </form>
                  <form method="POST" action="{{ route('profile.cart.drop', ['userId' => Auth::user()->user_id, 'productId' => $product->product_id]) }}">                
                    @csrf
                    <button class="btn btn-warning" type="submit" >Restar</button>
                  </form>
                  <form method="POST" action="{{ route('profile.cart.delete', ['userId' => Auth::user()->user_id, 'productId' => $product->product_id]) }}">                
                    @csrf
                    <button class="btn btn-danger" type="submit" >Eliminar</button>
                  </form>
              </td>
            </tr>
        @endforeach
      </tbody>
  </table>  
  <div class="cart-total">
      <p class="text-right align-middle"><b>Total:</b></p>
      <p class="align-middle"><b>${{$cart->total}}</b></p>
  </div>

  <form action="{{ route('checkout.form', ['cartId' => $cart->cart_id, 'userId' => Auth::user()->user_id]) }}" method="GET">
    <button class="btn btn-primary">Confirmar compra</button>   
  </form>
@endsection