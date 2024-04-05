<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final | @yield('title')</title>
    <link rel="stylesheet" href="<?= url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= url('css/styles.css'); ?>">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
            <div class="container-fluid d-flex justify-content-end">           
                <h1 class="text-white fs-3">Keep Moving</h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#navbarModal">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= route('home'); ?>">Inicio</a>
                        </li>
                        @auth
                            @if (Auth::user()->rol == 1)
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= route('admin.dashboard'); ?>">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= route('products.dashboard'); ?>">Productos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= route('news.dashboard'); ?>">Noticias</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= route('products.index'); ?>">Productos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= route('news.index'); ?>">Noticias</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= route('profile.index', ['id' => Auth::user()->user_id]); ?>">Mi Perfil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= route('profile.cart', ['id' => Auth::user()->user_id]); ?>">Mi Carrito</a>
                                </li>
                            @endif
                            <li>
                                <form action="<?= route('auth.logout.process'); ?>" method="post">
                                    @csrf
                                    <button type="submit" class="btn cerrar-sesion">Cerrar Sesion</button>
                                </form>
                            </li> 
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= route('products.index'); ?>">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= route('news.index'); ?>">Noticias</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= route('auth.login.form'); ?>">Iniciar Sesión</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="<?= route('auth.signup.form'); ?>">Crear Cuenta</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        
        <main class="py-5">

            @if (\Session::has('status.message'))
                <div class="alert alert-{{\Session::get('status.type', 'success')}}"> {!! \Session::get('status.message') !!} </div>
            @endif

            @yield('content')

        </main>
        <footer class="footer">
            <p>Edmundo Alvarez - Da Vinci &copy; 2023</p>
        </footer>
    </div>
</body>
</html>
