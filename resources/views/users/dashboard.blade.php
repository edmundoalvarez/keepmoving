@php
    /* @var \App\Models\Product[] */
@endphp

@extends('layouts.main')

@section('title', 'Dashboard Usuarios')

@section('content')
    <h2 class="mb-4">Dashboard usuarios</h2>

    <div class="d-flex align-content-start flex-wrap gap-3">
        @foreach ($users as $user)
            @if ($user->rol != 1)
                <div class="card wd">
                    <div class="card-body d-flex flex-column flex-wrap gap-2">
                        <h3 class="card-title mb-0"><b>{{$user->name}}</b></h3>
                        
                        <p class="card-text">{{$user->email}}</p>
                        
                        <div class="card-text d-flex flex-column flex-wrap gap-2">
                            
                            <a href="{{ route('user.purchases', ['id' => $user->user_id]) }}" class="btn btn-outline-secondary">Ver compras</a>
                            
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>  
@endsection

