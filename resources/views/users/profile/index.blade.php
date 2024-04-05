@extends('layouts.main')

@section('title', 'Mi perfil')

@section('content')
  <h2>Mi perfil</h2>

  <div class="datos mt-4">
    <div class="bg-white">
      <p>Mi nombre: <b>{{$user->name}}</b></p>
      <p>Mi email: <b>{{$user->email}}</b></p>
    </div>
    <div class="mt-4">
      <a href="{{ route('profile.update.form', ['id' => $user->user_id]) }}" class="btn btn-warning">Editar mis datos</a>
      <a class="btn btn-secondary" href="<?= route('profile.purchases', ['id' => Auth::user()->user_id]); ?>">Ver mis Compras</a>
    </div>
  </div>
@endsection