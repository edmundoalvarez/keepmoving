<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

/** @var Product[]|Collection $products  */
/** @var Preference $preference */
/** @var string $mpPublicKey */
/** @var int $totalPrice */

class MercadoPagoController extends Controller
{
    public function showForm($cartId, $userId)
    {
        
        $cart = Cart::findOrFail($cartId);
        $products = $cart->products;

        $items = [];
        foreach($products as $product){
            $items[] = [
                'name' => $product->name,
                'unit_price' => $product->price,
                'quantity' => $product->pivot->quantity,
                'currency_id' => 'ARS'

            ];
        }

        MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));

        $client = new PreferenceClient();
        $preference = $client->create([
            'items' => $items,

            'back_urls' => [
                'success' => route('checkout.success'),
                'pending' => route('checkout.pending'),
                'failed' => route('checkout.failed'),
            ]
        ]);

        return view('checkout.form', [
            'products' => $products,
            'cart' => $cart,
            'preference' => $preference,
            'mpPublicKey' => env('MP_PUBLIC_KEY'),
        ]);

    }
    
    public function success(Request $request)
    {
        $cart = Cart::findOrFail(auth()->user()->cart_id);

        $purchase = Purchase::create([
            'user_id' => auth()->user()->user_id,
            'total' => $cart->total,
        ]);

        foreach ($cart->products as $product) {
            $purchase->products()->attach($product->product_id, [
                'quantity' => $product->pivot->quantity,
                'subtotal' => $product->price * $product->pivot->quantity,
            ]);
        }

        $cart->products()->detach();
        $cart->total = 0;
        $cart->save();
        
        return view('checkout.success');
    }
    public function pending(Request $request)
    {
        return view('checkout.pending');   
    }
    public function failed(Request $request)
    {
        return view('checkout.failed');   
    }
}
