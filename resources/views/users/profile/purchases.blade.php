@extends('layouts.main')

@section('title', 'Mis compras')

@section('content')
  <a class="btn btn-warning float-start flex-fill btn-volver" href="{{ url('/mi-perfil/' . $user->user_id) }}">Volver</a>

  <h2 class="mb-4 mis-compras-title">Mis compras</h2>

  <div class="d-flex align-content-start flex-wrap gap-3">
    @forelse($purchases as $purchase)
      <div class=" card-cart card wd">
          <div class="card-body d-flex flex-column flex-wrap gap-2">
            <h3 class="card-title mb-0">Compra: #<b>{{$purchase->purchase_id}}</b></h3>
            
            <div class="cart-data">
                <p><b>Usuario: </b>{{$purchase->user->name}}</p>
                <p><b>Email: </b>{{$purchase->user->email}}</p>
                <p><b>Fecha: </b>{{$purchase->created_at}}</p>                
            </div>
            
            <table class="cart-table table">
                <thead>
                  <tr>
                    <th scope="col">Productos</th>
                    <th scope="col">Talle</th>
                    <th scope="col" class="cart-table-num">Cantidad</th>
                    <th scope="col" class="cart-table-num">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($purchase->products as $product)
                  <tr class="cart-tr">
                    <td>{{$product->name}}</td>
                    <td class="cart-size">
                      @forelse ($product->sizes as $size)
                        <span class="size-compra"><b>{{$size->name}}</b></span> 
                      @empty
                        <span class="no-size-compra">No Especificado</span> 
                      @endforelse
                    </td>
                    <td class="cart-table-num">{{$product->pivot->quantity}}</td>
                    <td class="cart-table-num">${{$product->pivot->subtotal / 100}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            
            <div class="cart-total">
              <p><b>Total: ${{$purchase->total}}</b></p>
            </div>
          </div>
      </div>
    @empty
      <p>- No hay compras -</p>
      
    @endforelse
  </div>   
@endsection