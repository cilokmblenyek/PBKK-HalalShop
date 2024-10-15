<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\produkController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [produkController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/produk/{produk}', [produkController::class, 'show'])->name('products.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{p_id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{p_id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/increase/{p_id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease/{p_id}', [CartController::class, 'decrease'])->name('cart.decrease');


require __DIR__.'/auth.php';