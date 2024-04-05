<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
    public function cartWithUser(int $id)
    {
        $user = User::findOrFail($id);

        $allCarts = Cart::with(['user'])->orderBy('cart_id', 'desc')->get();
        $carts = $allCarts->where('user_id', $id);

        return view('users.carts', [
            'carts' => $carts,
            'user' => $user
        ]);
    }

    public function myProfileCart(int $id)
    {
        $user = User::findOrFail($id);

        $cart = Cart::findOrFail($user->cart_id);
        
        return view('users.profile.cart', [
            'cart' => $cart,
            'user' => $user
        ]);
    }

    public function processAdd($userId, $productId)
    {
        $product = Product::findOrFail($productId);
        
        try {
    
            DB::transaction(function () use ($product, $productId) {

                $cart = Cart::findOrFail(auth()->user()->cart_id);

                $subtotal = $product->price * 100;
                
                if ($cart->products->contains('product_id', $productId)) {
                    $productoEnCarrito = $cart->products()->where('carts_have_products.product_id', $productId)->first()->pivot;
                    $productoEnCarrito->quantity += 1;
                    $productoEnCarrito->subtotal = $productoEnCarrito->quantity * ($product->price * 100);
                    $productoEnCarrito->save();

                } else {
                    $cart->products()->attach($productId, [
                        'quantity' => 1,
                        'subtotal' => $subtotal,
                    ]);
                }

                $cart->total += $subtotal / 100;
                $cart->save();
            });
    
            return redirect()
                ->route('profile.cart',['id' => $userId])
                ->with('status.message', 'El producto <b>' . e($product['name']) . '</b> se agregó correctamente');
    
        } catch (\Exception $e) {
            Debugbar::addThrowable($e);
    
            return redirect()
                ->back()
                ->with('status.message', 'El producto <b>' . $product->name . '</b> no se pudo agregar. Mesasge: ' . $e->getMessage())
                ->with('status.type', 'danger') ;
        }
    }

    public function processDrop($userId, $productId)
    {
        $product = Product::findOrFail($productId);
        
        try {
    
            DB::transaction(function () use ($product, $productId) {

                $cart = Cart::findOrFail(auth()->user()->cart_id);

                $subtotal = $product->price * 100;
                
                $productoEnCarrito = $cart->products()->where('carts_have_products.product_id', $productId)->first()->pivot;
                if ($productoEnCarrito->quantity > 1) {
                    $productoEnCarrito->quantity -= 1;
                    $productoEnCarrito->subtotal = $productoEnCarrito->quantity * ($product->price * 100);
                    $productoEnCarrito->save();

                } else {

                    $cart->products()->detach($productId);
                }

                $cart->total -= $subtotal / 100;
                $cart->save();
            });
    
            return redirect()
                ->route('profile.cart',['id' => $userId])
                ->with('status.message', 'El producto <b>' . e($product['name']) . '</b> se restó correctamente');
    
        } catch (\Exception $e) {
            Debugbar::addThrowable($e);
    
            return redirect()
                ->back()
                ->with('status.message', 'El producto <b>' . $product->name . '</b> no se pudo restar. Mesasge: ' . $e->getMessage())
                ->with('status.type', 'danger') ;
        }
    }

    public function processDelete($userId, $productId)
    {        
        $product = Product::findOrFail($productId);

        try {
            DB::transaction(function () use ($userId, $productId) {
                $cart = Cart::findOrFail(auth()->user()->cart_id);
                
                $subtotal = $cart->products()->where('carts_have_products.product_id', $productId)->first()->pivot->subtotal;
    
                $cart->products()->detach($productId);

                $cart->total -= $subtotal / 100;
                $cart->save();
            });
    
            return redirect()
                ->route('profile.cart', ['id' => $userId])
                ->with('status.message', 'El producto se eliminó correctamente');
        } catch (\Exception $e) {
            Debugbar::addThrowable($e);
    
            return redirect()
                ->back()
                ->with('status.message', 'No se pudo eliminar el producto. Mensaje: ' . $e->getMessage())
                ->with('status.type', 'danger');
        }
    }
}
