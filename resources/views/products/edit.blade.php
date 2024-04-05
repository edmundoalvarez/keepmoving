@php
    use Illuminate\Database\Eloquent\Collection;

    use App\Models\Color;
    use App\Models\Size;

    /** @var \Illuminate\Support\ViewErrorBag $errors */
    /** @var Product $product */
    /** @var Color|Collection $colors */
    /** @var Size|Collection $sizes */

@endphp

@extends('layouts.main')

@section('title', 'Editar ' . $product->name)

@section('content')
<h2 class="mb-2">Editar "{{$product->name}}"</h2>

@if($errors->any())
<p class="mb-3 text-danger"> Hay errores en la validación. Por favor, corregirlos</p>
@endif

<form class="my-3" action="{{ url('/dashboard/productos/' . $product->product_id . '/editar')}}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="form-div">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $product->name) }}"
                @error('name')
                    aria-describedby="error-name"
                    aria-invalid="true"                
                @enderror
            >
            <div id="emailHelp" class="form-text">El nombre del producto debe tener como mínimo 100 caracteres.</div>
            @error('name')
            <p class="mb-3 text-danger" id="error-name"> {{$message}}</p>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input 
                type="text" 
                id="price" 
                name="price" 
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $product->price) }}"
                @error('price')
                    aria-describedby="error-price"
                    aria-invalid="true"                
                @enderror
            >
            @error('price')
            <p class="mb-3 text-danger" id="error-price"> {{$message}}</p>
            @enderror
        </div>
    </div>

    <div class="form-div">
        <div class="mb-3">
            <label for="color_id" class="form-label">Color</label>
            <select 
                name="color_id" 
                id="color_id" 
                class="form-control @error('color_id') is-invalid @enderror"
                @error('color_id')
                aria-describedby="error-color_id"
                aria-invalid="true"                
                @enderror
            >
                @foreach ($colors as $color)
                <option 
                    value="{{ $color->color_id }}" 
                    @selected(old('color_id', $product->color_id) == $color->color_id)
                >
                    {{ $color->name }}
                </option>    
                @endforeach
            </select>
            @error('color_id')
            <p class="mb-3 text-danger" id="error-color_id"> {{$message}}</p>
            @enderror
        </div>

        <fieldset class="fieldset-talle mb-3">
            <legend class="form-label legend-talles">Talles</legend>
            <div class="div-talles">
                @foreach ($sizes as $size)
                    <label for="{{$size->name}}">
                        <input 
                            type="checkbox" 
                            name="sizes[]" 
                            id="{{$size->name}}" 
                            class="form-check-input" 
                            value="{{ $size->size_id }}"
                            @checked(in_array($size->size_id, old('sizes', $product->sizes->pluck('size_id')->all() )))
                        >
                        <span>{{$size->name}}</span>
                    </label>
                @endforeach
            </div>
        </fieldset>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea 
            id="description" 
            name="description" 
            class="form-texto form-control @error('description') is-invalid @enderror"
            @error('description')
                aria-describedby="error-description"
                aria-invalid="true"                
            @enderror
        >{{ old('description', $product->description) }}</textarea>
        @error('description')
        <p class="mb-3 text-danger" id="error-description"> {{$message}}</p>
        @enderror
    </div>

    <div class="form-div">
        <div class="mb-3">
            <label for="image" class="form-label">Imagen del producto</label>
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
                value="{{ old('image_description', $product->image_description) }}"
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
        <button type="submit" class="btn btn-warning">Confirmar edición</button>
        <a class="btn btn-secondary" href="<?= url('/dashboard/productos'); ?>">Cancelar</a>
    </div>

</form>
@endsection

