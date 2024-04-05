@extends('layouts.main')

@section('title', 'Productos')

@section('content')
    <h2 class="mb-4">Dashboard</h2>

    <div>
        <p>En el dashboard podrás administrar todos los datos del sitio. Tendrás la posibilidad de crear, modificar o eliminar tanto productos como noticias. Además podrás gestionar las compras realizadas por los usuarios.</p>
    </div>

    <div class="dashboard-menu">
        <ul>
            <li class="dashboard-li">
                <a href="<?= route('products.dashboard'); ?>">Productos</a>
            </li>
            <li class="dashboard-li">
                <a href="<?= route('news.dashboard'); ?>">Noticias</a>
            </li>
            <li class="dashboard-li">
                <a href="<?= route('users.dashboard'); ?>">Usuarios</a>
            </li>
        </ul>
    </div>

    <div class="estadistica">
        <h3>Total facturado por mes</h3>
        @foreach ($purchases as $purchase)
            <div class="mt-4">
                <div class="data">
                    <div>
                        <p>Mes</p>
                        <p class="data-content">{{ $purchase->month }}</p>
                    </div>
                    <div>
                        <p>Total</p>
                        <p class="data-content">${{ $purchase->total }}</p>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection

