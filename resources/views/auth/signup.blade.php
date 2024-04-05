@extends('layouts.main')

@section('title', 'Crear Cuenta')

@section('content')
    <h2 class="mb-4">Crear cuenta</h2>

    <form class="login" action="{{ route('auth.signup.process') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email') }}"
                @error('email')
                    aria-describedby="error-email"
                    aria-invalid="true"                
                @enderror
            >
            @error('email')
            <p class="mb-3 text-danger" id="error-email"> {{$message}}</p>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror"
                @error('password')
                    aria-describedby="error-password"
                    aria-invalid="true"                
                @enderror
            >
            @error('password')
            <p class="mb-3 text-danger" id="error-password"> {{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password-confirm" class="form-label">Confirmación de contraseña</label>
            <input 
                type="password" 
                id="password-confirm" 
                name="password_confirmation" 
                class="form-control @error('password_confirmation') is-invalid @enderror"
                
            >
            @error('password_confirmation')
                <p class="mb-3 text-danger">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-warning">Confirmar</button>
    </form>
@endsection