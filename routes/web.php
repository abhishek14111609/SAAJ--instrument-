<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\ProductController;

// ── Home (dynamic – uses existing DB) ──────────────────────────────
Route::get('/', function () {
    $categories = Category::with('products.variants')->get();
    return view('welcome', compact('categories'));
})->name('home');

// ── Product Detail (dynamic – existing) ────────────────────────────
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// ── Shop (static layout, products wired via existing DB) ───────────
Route::get('/shop', function () {
    $categories = Category::with('products.variants')->get();
    $products   = \App\Models\Product::with('variants', 'category')->latest()->get();
    return view('shop.index', compact('products', 'categories'));
})->name('shop');

// ── Static Pages ────────────────────────────────────────────────────
Route::view('/cart',         'cart.index'          )->name('cart');
Route::view('/checkout',     'checkout.index'      )->name('checkout');
Route::view('/confirmation', 'orders.confirmation' )->name('order.confirmation');
Route::view('/track-order',  'orders.track'        )->name('order.track');
Route::view('/about',        'about'               )->name('about');
Route::view('/contact',      'contact'             )->name('contact');
Route::view('/login',        'auth.login'          )->name('login');
Route::view('/register',     'auth.register'       )->name('register');
Route::view('/wishlist',     'wishlist'            )->name('wishlist');
