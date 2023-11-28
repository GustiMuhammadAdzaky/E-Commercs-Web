<?php

use App\Http\Controllers\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\OptionsAdmin;
use App\Http\Controllers\Admin\ProductsAdmin;
use App\Http\Controllers\Admin\Login;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Carts;
use App\Http\Controllers\CheckOut;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// No Role
Auth::routes();
Route::get('/', [Product::class, 'index']);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail', [App\Http\Controllers\Product::class, 'detail'])->name('detail.produk');
// Admin
Route::get('/dashboard', [Dashboard::class, 'index'])->middleware('checkRole:admin');
Route::get('/optionsadmin', [OptionsAdmin::class, 'index'])->middleware('checkRole:admin');
Route::post('optionsadmin/ubah', [OptionsAdmin::class, 'ubahAdmin'])->middleware('checkRole:admin');
Route::group(['middleware' => ['checkRole:admin']], function () {
    Route::get('/kelola_produk', [ProductsAdmin::class, 'index']);
    Route::get('/kelola_produk/detail', [ProductsAdmin::class, 'detail']);
    Route::get('/kelola_produk/tambah_produk', [ProductsAdmin::class, 'tambahProduk']);
    Route::post('/kelola_produk/tambah_validation', [ProductsAdmin::class, 'tambahValidation']);
    Route::post('/kelola_produk/ubah_validation', [ProductsAdmin::class, 'ubahValidation']);
    Route::post('/kelola_produk/delete_produk', [ProductsAdmin::class, 'deleteProduk']);
});
// Pembeli
Route::get('/pembeli', function () {
    return view('pembeli');
})->middleware(['checkRole:pembeli,admin']);
Route::group(['middleware' => ['checkRole:pembeli,admin']], function () {
    Route::get('cart', [Carts::class, 'cartList'])->name('cart.list');
    Route::get('produk', [Product::class, 'index'])->name('products.list');
    Route::post('cart', [Carts::class, 'addToCart'])->name('cart.store');
    Route::post('update-cart', [Carts::class, 'updateCart'])->name('cart.update');
    Route::post('remove', [Carts::class, 'removeCart'])->name('cart.remove');
    Route::post('clear', [Carts::class, 'clearAllCart'])->name('cart.clear');
    // check out
    Route::post('/detail/checkout', [CheckOut::class, 'store'])->name('checkout.store');
});
