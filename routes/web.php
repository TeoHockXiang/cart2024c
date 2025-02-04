<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contactUs', function () {
    return view('contact');
});

Route::get('/addProduct', function () {
    return view('addProduct');
});

Route::post('/addProduct/store',
[App\Http\Controllers\ProductController::class,'add'])->name('addProduct'); // directory name -> route name

Route::get('/showProduct',
[App\Http\Controllers\ProductController::class,'show'])->name('showProduct');

Route::get('/editProduct/{id}',
[App\Http\Controllers\ProductController::class,'edit'])->name('editProduct');

Route::post('/updateProduct',
[App\Http\Controllers\ProductController::class,'update'])->name('updateProduct');

Route::get('/deleteProduct/{id}',
[App\Http\Controllers\ProductController::class,'delete'])->name('deleteProduct');

Route::get('/productDetail/{id}',
[App\Http\Controllers\ProductController::class,'detail'])->name('productDetail');

Route::post('/addCart',
[App\Http\Controllers\CartController::class,'addCart'])->name('addCart');

Route::get('/myCart',
[App\Http\Controllers\CartController::class,'view'])->name('myCart');

Route::post('/checkout',
[App\Http\Controllers\PaymentController::class,'paymentPost'])->name('payment.post');

Route::post('/search',
[App\Http\Controllers\ProductController::class,'search'])->name('searchProduct');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
