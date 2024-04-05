@extends('layouts.main')

@section('title', 'Iniciar sesión')

@section('content')
    <h2 class="mb-4">Iniciar sesión</h2>

    <form class="login" action="{{route('auth.login.process') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email') }}"
            >
            @error('email')
            <p class="mb-3 text-danger"> {{$message}}</p>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror"
            >
            @error('password')
            <p class="mb-3 text-danger"> {{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-warning">Ingresar</button>
    </form>
@endsection