@extends('layouts.main')

@section('title', $product->name)
    
@section('content')
    <div class="producto-detalle d-flex flex-column">
        <div class="title">
            <a class="btn btn-warning float-start flex-fill btn-volver" href="{{URL::previous()}}">Volver</a>
    
            <h2 class="mb-4 view-title"><b>{{$product->name}}</b></h2>
        </div>
        <div>
            <div class="flex-shrink-0 mb-4 img-product-view">
                <picture>
                @if ($product->image !== null)
                    <img src="{{ asset('/storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->image_description }}">   
                @else
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPAAAAC0CAMAAACdQlHaAAAAJ1BMVEXv8PfR1d7Z3OTn6fDh5Ozl5+/d4OjW2uLr7fTa3ebm6O/i5ezq7PMVjo43AAAEO0lEQVR4nO3d2ZKkIBAFUBdcqPb/v3daW1AUxHJYkvTet4kxSk/gggnSVYUgCIIgCIIgCIIgCIIg78oomjpFBtnlpi75SaJdzQTIaVpXp3+Zt65FXq9I7a3rNqd3TO+th5zgDA2ct4n1FTw00TOofeW8itVBJHla9OvOZIqdOaLaN8nO1A2jSbI3e5KCK4DTB+AUewM4YVzgsRPi5zPG2Rs9sFCP5ybs85kouNVdovl/pvB7IwY+dq8/wfdGC3x+nQh3WlMEtydvXQc7qymCBws42AESBHcWb7gXWIJge4UrVOGNHthV8Qm7N0Jg2y1rzq0ul/BuRQ9sv4TvXcR93fjErMBy/hmPuByw/0ks/37nWkwPPDnA3t+R6ocuxfTAlQVb33hdltumV2KC4P6EneMrJMvdtldigmD7Oe25F0lj4wsxQbC1iT0NLA+bu8UUwZa3B89AwdF7ISYJHo9iT3fC1vt2iUmCq9Fssq/b90JME1xVP1sj++Zk2L0uMVVwVX362Tz0vi6ly+sQ0wXfjNtrF5cOvvJaxYWDr702cdlgn9ciLhk83pnfdRy2KBh8y3sSlwu+6T2KywBbHi+3vQdxEWBxru984TXFJYDnsbVDf+srryEuAPw3lmiIv/TuxfTBaux0J/7au3sekwdvY8Va/MC7VXmpg/dj46v4VB7gBDbnAiziZ95CwMe5D+1jbxngc/myfeotAmwr1z71lgC2j0DwBYf10gcH9pIHh/ZSBwf3EgeH99IGR/CSBsfwUgZH8RIGf6J4CYNd05YABhhggCuAcwRggAEGuGRwmr0BnDAAp9gbwAnzVnCojwuvMxEAq/GxPvSCDpboyQM5V4mLU7TzJOfyUpGqdtdJcDa583jM93lyLqfl/mI4YrI2cIZV8QKuC1KEOLv396xOuJanDLnSzfNMQsZf9LBpev8qAQiCIAiCIAjy1oj+r6KQ+zgipRvM8l+n6yf5jilm1rFGLd7erLMu9B8va3uqIuRurDVv2SpaTN3+mxem4FW41tX1CT3IgSl4Ja5f6alFELL+ZZLImcV68ZravKJ5Zmx1UU6tAfqaspWq6Oc+jmRhBW6XDqOcq6zD7kLd7lKHAZvCb9LTtghNV+3vxEzBxlBMxx9snZzHGGxfcZoxWM+J6IWQTvAohNpQzMl80P8R3cBLB0O4wBWbx5LYe7f25gtez2I10WhiD14V3eHfbMGnNwLu4JMCYKbg15zS6hp+zU1LmdRjqWMPVr3JyfwnX7DuTL6la7nNtpVCbJV2xmD7TEzGYPucec5gY4188QLw/qwW/J/DS8al1rFUaQ0VW/CWiaXqIuvZXXKRzp/d6Jhq4IKLdP6Mda9GCPXdi/UI4fK+8NvNEnLrdOU+pqixdLVofKgRK+dP11hfwZahlrB/ZZtcxsMp/YYvcSYhlxuWlIJ56yIIgiAIgiD/AN7pK7zfiRJlAAAAAElFTkSuQmCC" class="card-img-top" alt="...">
                @endif 
                </picture>           
            </div>

            <div class="d-flex flex-column gap-2">
                <h3 class="detalles-card">Detalles:</h3>
                <p>{{$product->description}}</p>
                <div>
                  @if ($product->color !== null)
                  <p>Color: <b>{{$product->color->name}}</b></p>  
                  @else             
                  <p>Color: <b>No especificado</b></p>  
                  @endif
                </div>

                <div class="sizes">
                    <p>Talles: </p>
                      @forelse ($product->sizes as $size) 
                          <p class="size"><b>{{$size->name}}</b></p> 
                      @empty
                          <p class="no-size">- No Especificado -</p> 
                      @endforelse
                </div>

                <p><b>${{$product->price}}</b></p>
            </div>
            @auth
                <form method="POST" action="{{ route('profile.cart.add', ['userId' => Auth::user()->user_id, 'productId' => $product->product_id]) }}">                
                    @csrf
                    <button type="submit" class="btn btn-warning mt-4 w-100">Agregar a carrito</button>
                </form>
            @else
                <a href="<?= route('auth.login.form'); ?>" class="btn btn-primary mt-4 w-100">Agregar a carrito</a>
            @endauth
            
        </div>
    </div>
@endsection
