@php
    use Illuminate\Pagination\LengthAwarePaginator;
    /** @var \App\Models\Product[]\Illuminate\Database\Eloquent\Collection\LengthAwarePaginator */
    /** @var array $searchParams */
@endphp

@extends('layouts.main')

@section('title', 'Productos')

@section('content')
    <h2 class="mb-4">Nuestros productos</h2>

    <div class=" mb-4 buscador">
        <form action="{{ route('products.index')}}" method="get">
            <div>
                <label for="search-name" class="form-label ">Buscador</label>
                <input 
                    type="text" 
                    id="search-name" 
                    name="search-name" 
                    class="form-control"
                    value="{{ $searchParams['name'] }}"
                >
            </div>
            <div>
                <button type="submit" class="btn btn-secondary">Buscar</button>
                <a class="btn btn-ver-todos" href="<?= route('products.index'); ?>">Ver todos</a>
            </div>
        </form>
    </div>

    <div class="products-all mt-[60px]">
        <div class="d-flex gap-3 flex-row flex-wrap product-container">
        @foreach ($products as $product)
            <div class="card wd">
                <div class="flex-shrink-0">
                    <picture>
                    @if ($product->image_small !== null)
                        <img src="{{ asset('/storage/' . $product->image_small) }}" class="card-img-top" alt="{{ $product->image_description }}">   
                    @else
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPAAAAC0CAMAAACdQlHaAAAAJ1BMVEXv8PfR1d7Z3OTn6fDh5Ozl5+/d4OjW2uLr7fTa3ebm6O/i5ezq7PMVjo43AAAEO0lEQVR4nO3d2ZKkIBAFUBdcqPb/v3daW1AUxHJYkvTet4kxSk/gggnSVYUgCIIgCIIgCIIgCIIg78oomjpFBtnlpi75SaJdzQTIaVpXp3+Zt65FXq9I7a3rNqd3TO+th5zgDA2ct4n1FTw00TOofeW8itVBJHla9OvOZIqdOaLaN8nO1A2jSbI3e5KCK4DTB+AUewM4YVzgsRPi5zPG2Rs9sFCP5ybs85kouNVdovl/pvB7IwY+dq8/wfdGC3x+nQh3WlMEtydvXQc7qymCBws42AESBHcWb7gXWIJge4UrVOGNHthV8Qm7N0Jg2y1rzq0ul/BuRQ9sv4TvXcR93fjErMBy/hmPuByw/0ks/37nWkwPPDnA3t+R6ocuxfTAlQVb33hdltumV2KC4P6EneMrJMvdtldigmD7Oe25F0lj4wsxQbC1iT0NLA+bu8UUwZa3B89AwdF7ISYJHo9iT3fC1vt2iUmCq9Fssq/b90JME1xVP1sj++Zk2L0uMVVwVX362Tz0vi6ly+sQ0wXfjNtrF5cOvvJaxYWDr702cdlgn9ciLhk83pnfdRy2KBh8y3sSlwu+6T2KywBbHi+3vQdxEWBxru984TXFJYDnsbVDf+srryEuAPw3lmiIv/TuxfTBaux0J/7au3sekwdvY8Va/MC7VXmpg/dj46v4VB7gBDbnAiziZ95CwMe5D+1jbxngc/myfeotAmwr1z71lgC2j0DwBYf10gcH9pIHh/ZSBwf3EgeH99IGR/CSBsfwUgZH8RIGf6J4CYNd05YABhhggCuAcwRggAEGuGRwmr0BnDAAp9gbwAnzVnCojwuvMxEAq/GxPvSCDpboyQM5V4mLU7TzJOfyUpGqdtdJcDa583jM93lyLqfl/mI4YrI2cIZV8QKuC1KEOLv396xOuJanDLnSzfNMQsZf9LBpev8qAQiCIAiCIAjy1oj+r6KQ+zgipRvM8l+n6yf5jilm1rFGLd7erLMu9B8va3uqIuRurDVv2SpaTN3+mxem4FW41tX1CT3IgSl4Ja5f6alFELL+ZZLImcV68ZravKJ5Zmx1UU6tAfqaspWq6Oc+jmRhBW6XDqOcq6zD7kLd7lKHAZvCb9LTtghNV+3vxEzBxlBMxx9snZzHGGxfcZoxWM+J6IWQTvAohNpQzMl80P8R3cBLB0O4wBWbx5LYe7f25gtez2I10WhiD14V3eHfbMGnNwLu4JMCYKbg15zS6hp+zU1LmdRjqWMPVr3JyfwnX7DuTL6la7nNtpVCbJV2xmD7TEzGYPucec5gY4188QLw/qwW/J/DS8al1rFUaQ0VW/CWiaXqIuvZXXKRzp/d6Jhq4IKLdP6Mda9GCPXdi/UI4fK+8NvNEnLrdOU+pqixdLVofKgRK+dP11hfwZahlrB/ZZtcxsMp/YYvcSYhlxuWlIJ56yIIgiAIgiD/AN7pK7zfiRJlAAAAAElFTkSuQmCC" class="card-img-top" alt="...">
                    @endif
                    </picture>
                </div>
    
                <div class="card-body d-flex flex-column flex-wrap gap-2">
                  <h3 class="card-title mb-0"><b>{{$product->name}}</b></h3>
                  <p class="card-text">${{$product->price}}</p>
                  <div class="card-text d-flex flex-column flex-wrap gap-2">
                      
                    @if ($product->color !== null)
                        <p>Color: <b>{{$product->color->name}}</b></p>  
                    @else             
                        <p>Color: <b>No especificado</b></p>  
                    @endif
    
                    <div class="sizes">
                        <p>Talles: </p>
                          @forelse ($product->sizes as $size) 
                              <p class="size"><b>{{$size->name}}</b></p> 
                          @empty
                              <p class="no-size">No Especificado</p> 
                          @endforelse
                    </div>
                  </div>
                  
                    <a href="{{ route('products.view', ['id' => $product->product_id]) }}" class="btn btn-outline-secondary">Ver detalle</a>
                </div>
            </div>
        @endforeach
        </div>  
    </div>

    <div class="paginador">{{$products->links()}}</div>
@endsection

