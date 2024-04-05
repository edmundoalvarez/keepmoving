@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <picture class="banner-home">
        <img src="{{ asset('/imgs/banner-home.png') }}" alt="Hombre en linea de meta a punto de iniciar una maratón">
    </picture>

    <h2 class="mb-2 mt-4">¡Bienvenidos a Keep Moving!</h2>

    <p>En nuestro rincón virtual, celebramos a todos los entusiastas del movimiento y la vitalidad. Explora nuestra colección de prendas textiles deportivas diseñadas para acompañarte en cada paso de tu viaje activo. En Keep Moving nos esforzamos por brindarte calidad y estilo en cada prenda. Prepárate para elevar tu experiencia deportiva con nosotros.</p>
    
    <div class="mt-4 d-flex flex-column gap-4">
        <p>En esta web, no solo podrás ver nuestros productos de alta calidad, sino también podrás enterarte de las novedades y consejos de la marca para el cuidado de los productos.</p>
        
        <div class="mt-2 d-flex gap-4 m-auto">
            <a class="p-6 btn btn-danger buttons" href="<?= route('products.index'); ?>">Ver productos</a>
            
            <a class="p-6 btn btn-warning buttons" href="<?= route('news.index'); ?>">Ver noticias</a>
        </div>
    </div>
@endsection


         