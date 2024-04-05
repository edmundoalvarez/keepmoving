<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use DB;
use Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $searchParams = [
            'name' => $request->query('search-name'),
        ];

        $query = Product::with(['color', 'sizes']);

        if($searchParams['name'] !== null) {
            $query->where('name', 'LIKE', '%' . $searchParams['name'] . '%');
        }

        /** @var LengthAwarePaginator $query */
        $products = $query->paginate(3)->withQueryString();

        return view('products.index', [
            'products' => $products,
            'searchParams' => $searchParams
        ]);
    }
 
    public function view( int $id)
    {
        $product = Product::findOrFail($id);

        return view('products.view', [
            'product' => $product
        ]);
    }

    public function formCreate()
    {
        return view('products.create', [
            'colors' => Color::all(),
            'sizes' => Size::all(),
        ]);  
    }

    public function processCreate(Request $request)
    {
        try{
            $request->validate(Product::$rules, Product::$errorMessages);

            $data = $request->except(['_token']);

            if($request->hasFile('image')) {

                $uploadedImage  = $request->file('image');
                
                $smallImageName      = 'small-' . $uploadedImage->hashName();
                $resizedSmallImage   = Image::make($uploadedImage)->fit(286, 215)->encode('jpg');
                Storage::put('imgs/' . $smallImageName, $resizedSmallImage);
                $data['image_small'] = 'imgs/' . $smallImageName;

                $normalImageName      = 'normal-' . $uploadedImage->hashName();
                $resizedNormalImage   = Image::make($uploadedImage)->fit(500, 450)->encode('jpg');
                Storage::put('imgs/' . $normalImageName, $resizedNormalImage);
                $data['image'] = 'imgs/' . $normalImageName;
            }

            DB::transaction(function() use ($data) {
                /**
                 * @var Product
                 */
                $product = Product::create($data);
    
                $product->sizes()->attach($data['sizes'] ?? []);
                
            });


            return redirect()
                ->route('products.dashboard')
                ->with('status.message', 'El producto <b>' . e($data['name']) . '</b> se publicó correctamente');

        } catch(\Exception $e){
            Debugbar::addThrowable($e);

            return redirect()
                ->route('products.dashboard')
                ->with('status.message', 'El producto <b>' . e($data['name']) . '</b> no se pudo crear.')
                ->with('status.type', 'danger')
                ->withInput();
        }
    }

    public function formEdit(int $id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', [
            'product' => $product,
            'colors' => Color::all(),
            'sizes' => Size::all(),

        ]);

    }

    public function processEdit(int $id, Request $request)
    {
        try {
            $product = Product::findOrFail($id);
    
            $request->validate(Product::$rules, Product::$errorMessages);
    
            $data = $request->except(['_token']);
    
            if($request->hasFile('image')) {
                if($product->image && Storage::has($product->image)) {
                    Storage::delete($product->image);
                    Storage::delete($product->image_small);
                }
                
                $uploadedImage  = $request->file('image');
                
                $smallImageName      = 'small-' . $uploadedImage->hashName();
                $resizedSmallImage   = Image::make($uploadedImage)->fit(286, 215)->encode('jpg');
                Storage::put('imgs/' . $smallImageName, $resizedSmallImage);
                $data['image_small'] = 'imgs/' . $smallImageName;
    
                $normalImageName      = 'normal-' . $uploadedImage->hashName();
                $resizedNormalImage   = Image::make($uploadedImage)->fit(500, 450)->encode('jpg');
                Storage::put('imgs/' . $normalImageName, $resizedNormalImage);
                $data['image'] = 'imgs/' . $normalImageName;
    
            } else {
                $data['image'] = $product->image;
                $data['image_small'] = $product->image_small;
    
            }

            DB::transaction(function() use ($product, $data) {
                $product->update($data);

                $product->sizes()->sync($data['sizes'] ?? []);

                // throw new \Exception('Error al editar el producto');
                    
            });
    
            return redirect()
                ->route('products.dashboard')
                ->with('status.message', 'El producto <b>' . e($data['name']) . '</b> se editó correctamente');

        }catch(\Exception $e){
            Debugbar::addThrowable($e);

            return redirect()
                ->route('products.dashboard')
                ->with('status.message', 'El producto <b>' . e($data['name']) . '</b> no se pudo editar.')
                ->with('status.type', 'danger')
                ->withInput();
        }
    }

    public function formDelete(int $id)
    {
        $product = Product::findOrFail($id);

        return view('products.delete', [
            'product' => $product
        ]);

    }

    public function processDelete(int $id)
    {
        try{

            $product = Product::findOrFail($id);

            DB::transaction(function () use ($product){
                $product->sizes()->detach();
                $product->carts()->detach();
                $product->purchases()->detach();

                // throw new \Exception('Error al eliminar el producto');

                $product->delete(); 
                
            });

            if($product->image && Storage::has($product->image)) {
                Storage::delete($product->image);
                Storage::delete($product->image_small);
            }

            return redirect()
                ->route('products.dashboard')
                ->with('status.message', 'El producto <b>' . e($product->name) . '</b> se eliminó correctamente.');

        } catch(\Exception $e) {

            Debugbar::addThrowable($e);

            return redirect()
                ->route('products.dashboard')
                ->with('status.message', 'El producto <b>' . e($product->name) . '</b> no se pudo eliminar. Mensaje: '. $e->getMessage())
                ->with('status.type', 'danger');
        }
    }

    public function dashboard(Request $request)
    {

        $searchParams = [
            'name' => $request->query('search-name'),
        ];

        $query = Product::with(['color', 'sizes']);

        if($searchParams['name'] !== null) {
            $query->where('name', 'LIKE', '%' . $searchParams['name'] . '%');
        }

        /** @var LengthAwarePaginator $query */
        $products = $query->paginate(3)->withQueryString();

        return view('products.dashboard', [
            'products' => $products,
            'searchParams' => $searchParams
        ]);
    }
}
