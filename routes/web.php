<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ProductViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductViewController::class, 'index'])->name('user.products.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});

Route::middleware('auth')->group(function () {
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::get('/keranjang/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});
