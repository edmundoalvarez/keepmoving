@php

    use Illuminate\Database\Eloquent\Collection;

@endphp

@extends('layouts.main')

@section('title', 'Editar mis datos')

@section('content')
<h2 class="mb-2">Editar mis datos</h2>

@if($errors->any())
<p class="mb-3 text-danger"> Hay errores en la validación. Por favor, corregirlos</p>
@endif

<form class="my-3" action="{{ url('/mi-perfil/' . $user->user_id . '/editar')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-div">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}"
                @error('name')
                    aria-describedby="error-name"
                    aria-invalid="true"                
                @enderror
            >
            <div id="nameHelp" class="form-text">El nombre del usuario debe tener mínimo 3 caracteres</div>
            @error('name')
            <p class="mb-3 text-danger" id="error-name"> {{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}"
                @error('email')
                    aria-describedby="error-email"
                    aria-invalid="true"                
                @enderror
            >
            <div id="emailHelp" class="form-text">El email debe ser en un formato válido.</div>
            @error('email')
            <p class="mb-3 text-danger" id="error-email"> {{$message}}</p>
            @enderror
        </div>
    </div>

    <div class="buttons-edit mt-3">
        <button type="submit" class="btn btn-warning">Confirmar edición</button>
        <a class="btn btn-secondary" href="{{ url('/mi-perfil/' . $user->user_id) }}">Cancelar</a>
    </div>

</form>
@endsection

