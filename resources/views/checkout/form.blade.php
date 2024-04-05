@php
    /* @var \App\Models\Product[] */
@endphp

@extends('layouts.main')

@section('title', 'Carrito de compras')

@section('content')
    <h2 class="mb-4">Checkout</h2>

    <table class="table table-bordered table-striped">
        <thead class="bg-[#032832]">
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $products as $product )
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>${{ $product->pivot->subtotal / 100}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="align-right"><b>Total:</b></td>
                <td><b>${{$cart->total}}</b></td>
            </tr>
        </tbody>
    </table>

    <div id="checkout"></div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>

    const mp = new MercadoPago('<?= $mpPublicKey; ?>');

    mp.bricks().create('wallet', 'checkout', {
        initialization: {
            preferenceId: '<?= $preference->id ;?>'
        }
    });

</script>
@endsection

