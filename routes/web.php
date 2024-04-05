<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Rutas generales
 */
Route::get('/',[\App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::get('/iniciar-sesion', [\App\Http\Controllers\AuthController::class, 'formLogin'])
    ->name('auth.login.form');

Route::post('/iniciar-sesion', [\App\Http\Controllers\AuthController::class, 'processLogin'])
    ->name('auth.login.process');

Route::get('/crear-cuenta', [\App\Http\Controllers\UsersController::class, 'formSignup'])
    ->name('auth.signup.form');

Route::post('/crear-cuenta', [\App\Http\Controllers\UsersController::class, 'processSignup'])
    ->name('auth.signup.process');

Route::post('/cerrar-sesion', [\App\Http\Controllers\AuthController::class, 'processLogout'])
    ->middleware(['auth'])
    ->name('auth.logout.process');

Route::get('/productos/listado',[\App\Http\Controllers\ProductsController::class, 'index'])
    ->name('products.index');

Route::get('/productos/{id}',[\App\Http\Controllers\ProductsController::class, 'view'])
    ->whereNumber('id')
    ->name('products.view');

Route::get('/noticias/listado',[\App\Http\Controllers\NewsController::class, 'index'])
    ->name('news.index');

Route::get('/noticias/{id}',[\App\Http\Controllers\NewsController::class, 'view'])
    ->whereNumber('id')
    ->name('news.view');

/**
 * Rutas del usuario normal
 */
Route::get('/mi-perfil/{id}',[\App\Http\Controllers\UsersController::class, 'myProfile'])
    ->whereNumber('id')   
    ->middleware(['auth'])
    ->name('profile.index');

Route::get('/mi-perfil/{id}/editar', [\App\Http\Controllers\UsersController::class, 'formEdit'])
    ->whereNumber('id')
    ->middleware(['auth'])
    ->name('profile.update.form');

Route::post('/mi-perfil/{id}/editar', [\App\Http\Controllers\UsersController::class, 'processEdit'])
    ->whereNumber('id')
    ->middleware(['auth'])
    ->name('profile.update.process');

Route::get('/mi-perfil/{id}/compras',[\App\Http\Controllers\PurchasesController::class, 'myProfilePurchase'])
    ->whereNumber('id')   
    ->middleware(['auth'])
    ->name('profile.purchases');

Route::get('/mi-perfil/{id}/carrito',[\App\Http\Controllers\CartsController::class, 'myProfileCart'])
    ->whereNumber('id')   
    ->middleware(['auth'])
    ->name('profile.cart');

Route::post('/mi-perfil/{userId}/carrito/{productId}', [\App\Http\Controllers\CartsController::class, 'processAdd'])    
    ->middleware(['auth'])
    ->name('profile.cart.add');

Route::post('/mi-perfil/{userId}/carrito/{productId}/drop', [\App\Http\Controllers\CartsController::class, 'processDrop'])    
    ->middleware(['auth'])
    ->name('profile.cart.drop');
    
Route::post('/mi-perfil/{userId}/carrito/{productId}/delete', [\App\Http\Controllers\CartsController::class, 'processDelete'])    
    ->middleware(['auth'])
    ->name('profile.cart.delete');


/**
 * Rutas del usuario administrador
 */
 Route::get('/dashboard',[\App\Http\Controllers\AdminController::class, 'index'])
    ->middleware(['admin-user'])
    ->name('admin.dashboard');

Route::get('/dashboard/productos/nuevo', [\App\Http\Controllers\ProductsController::class, 'formCreate'])
    ->middleware(['admin-user'])
    ->name('product.create.form');

Route::post('/dashboard/productos/nuevo', [\App\Http\Controllers\ProductsController::class, 'processCreate'])
    ->middleware(['admin-user'])
    ->name('product.create.process');

Route::get('/dashboard/productos/{id}/editar', [\App\Http\Controllers\ProductsController::class, 'formEdit'])
    ->whereNumber('id')
    ->middleware(['admin-user'])
    ->name('product.update.form');

Route::post('/dashboard/productos/{id}/editar', [\App\Http\Controllers\ProductsController::class, 'processEdit'])
    ->whereNumber('id')
    ->middleware(['admin-user'])
    ->name('product.update.process');

Route::get('/dashboard/productos/{id}/eliminar', [\App\Http\Controllers\ProductsController::class, 'formDelete'])
    ->whereNumber('id')
    ->middleware(['admin-user'])
    ->name('product.delete.form');

Route::post('/dashboard/productos/{id}/eliminar', [\App\Http\Controllers\ProductsController::class, 'processDelete'])
    ->whereNumber('id')
    ->middleware(['admin-user'])
    ->name('product.delete.process');

Route::get('/dashboard/productos',[\App\Http\Controllers\ProductsController::class, 'dashboard'])
    ->middleware(['admin-user'])
    ->name('products.dashboard');

Route::get('/dashboard/noticias/nueva', [\App\Http\Controllers\NewsController::class, 'formCreate'])
    ->middleware(['admin-user'])
    ->name('news.create.form');

Route::post('/dashboard/noticias/nuevo', [\App\Http\Controllers\NewsController::class, 'processCreate'])
    ->middleware(['admin-user'])
    ->name('news.create.process');

Route::get('/dashboard/noticias/{id}/editar', [\App\Http\Controllers\NewsController::class, 'formEdit'])
    ->whereNumber('id')
    ->middleware(['admin-user'])
    ->name('news.update.form');

Route::post('/dashboard/noticias/{id}/editar', [\App\Http\Controllers\NewsController::class, 'processEdit'])
    ->whereNumber('id')
    ->middleware(['admin-user'])
    ->name('news.update.process');

Route::get('/dashboard/noticias/{id}/eliminar', [\App\Http\Controllers\NewsController::class, 'formDelete'])
    ->whereNumber('id')
    ->middleware(['admin-user'])
    ->name('news.delete.form');

Route::post('/dashboard/noticias/{id}/eliminar', [\App\Http\Controllers\NewsController::class, 'processDelete'])
    ->whereNumber('id')
    ->middleware(['admin-user'])
    ->name('news.delete.process');

Route::get('/dashboard/noticias',[\App\Http\Controllers\NewsController::class, 'dashboard'])
    ->middleware(['admin-user'])
    ->name('news.dashboard');

Route::get('/dashboard/users',[\App\Http\Controllers\UsersController::class, 'dashboard'])
    ->middleware(['admin-user'])
    ->name('users.dashboard');

Route::get('/dashboard/users/{id}/purchases',[\App\Http\Controllers\PurchasesController::class, 'purchaseWithUser'])
    ->whereNumber('id')   
    ->middleware(['admin-user'])
    ->name('user.purchases');


/* Ejemplo de MPago */
Route::get('{userId}/checkout/{cartId}/form', [\App\Http\Controllers\MercadoPagoController::class, 'showForm'])
    ->whereNumber('userId', 'cartId') 
    ->middleware(['auth'])   
    ->name('checkout.form');

Route::get('/checkout/success', [\App\Http\Controllers\MercadoPagoController::class, 'success'])
    ->name('checkout.success');
Route::get('/checkout/pending', [\App\Http\Controllers\MercadoPagoController::class, 'pending'])
    ->name('checkout.pending');
Route::get('/checkout/failed', [\App\Http\Controllers\MercadoPagoController::class, 'failed'])
    ->name('checkout.failed');

