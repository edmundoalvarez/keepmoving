@php
    use Illuminate\Database\Eloquent\Collection;

    /** @var \Illuminate\Support\ViewErrorBag $errors */
    /** @var News $news */
@endphp

@extends('layouts.main')

@section('title', 'Editar ' . $news->title)

@section('content')

<h2 class="mb-2">Editar "{{$news->title}}"</h2>

@if($errors->any())
<p class="mb-3 text-danger"> Hay errores en la validación. Por favor, corregirlos</p>
@endif

<form class="my-3" action="{{ url('/dashboard/noticias/' . $news->news_id . '/editar')}}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input 
            type="text" 
            id="title" 
            name="title" 
            class="form-control @error('title') is-invalid @enderror"
            value="{{ old('title', $news->title) }}"
            @error('title')
                aria-describedby="error-name"
                aria-invalid="true"                
            @enderror
        >
        <div class="form-text">El título de la noticia debe tener 40 caracteres como máximo.</div>
        @error('title')
        <p class="mb-3 text-danger" id="error-title"> {{$message}}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="lead" class="form-label">Bajada</label>
        <textarea 
            id="lead" 
            name="lead" 
            class="form-bajada form-control @error('lead') is-invalid @enderror"
            @error('lead')lead
                aria-describedby="error-lead"
                aria-invalid="true"                
            @enderror
        >{{ old('lead', $news->lead) }}</textarea>
        <div class="form-text">La bajada de la noticia debe tener entre 40 y 100 caracteres.</div>
        @error('lead')
        <p class="mb-3 text-danger" id="error-lead"> {{$message}}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="text" class="form-label">Texto</label>
        <textarea 
            id="text" 
            name="text" 
            class="form-texto form-control @error('text') is-invalid @enderror"
            @error('text')
                aria-describedby="error-text"
                aria-invalid="true"                
            @enderror
        >{{ old('text', $news->text) }}</textarea>
        <div class="form-text">El texto de la noticia debe tener como mínimo 100 caracteres.</div>
        @error('text')
        <p class="mb-3 text-danger" id="error-text"> {{$message}}</p>
        @enderror
    </div>

    <div class="form-div">
        <div class="mb-3">
            <label for="image" class="form-label">Imagen de la noticia</label>
            <input 
                type="file" 
                id="image" 
                name="image" 
                class="form-control @error('image') is-invalid @enderror"
                @error('image')
                    aria-describedby="error-image"
                    aria-invalid="true"                
                @enderror
            >
            @error('image')
            <p class="mb-3 text-danger" id="error-cover"> {{$message}}</p>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="image_description" class="form-label">Descripcion de la imagen</label>
            <input 
                type="text" 
                id="image_description" 
                name="image_description" 
                class="form-control @error('image_description') is-invalid @enderror"
                value="{{ old('image_description', $news->image_description) }}"
                @error('image_description')
                    aria-describedby="error-image_description"
                    aria-invalid="true"                
                @enderror
            >
            @error('image_description')
            <p class="mb-3 text-danger" id="error-image_description"> {{$message}}</p>
            @enderror
        </div>
    </div>

    <div class="buttons-edit mt-3">
        <button type="submit" class="btn btn-warning">Editar</button>
        <a class="btn btn-secondary" href="<?= url('/dashboard/noticias'); ?>">Cancelar</a>
    </div>
</form>
@endsection

