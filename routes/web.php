<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;

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


Route::get('/signup',[SignupController::class, 'signup']);
Route::post('/usersignup',[SignupController::class, 'usersignup']);
Route::get('/login',[SignupController::class, 'login'])->name('login');
Route::get('/home/logout',[SignupController::class, 'logout']);
Route::post('/user_authenticate',[SignupController::class, 'user_authenticate']);

Route::middleware(['auth'])->group(function () {

	Route::get('/',[HomeController::class, 'index'])->name('products');
    Route::get('/addproduct',[ProductController::class, 'product']);
    Route::post('/createproduct',[ProductController::class, 'create']);
	
	Route::post('/upcart',[CartController::class, 'store'])->name('upcart');
	Route::get('/dcart/{id}',[CartController::class, 'destroy']);

	Route::get('/cart', [ProductsController::class,'cart'])->name('cart');
	Route::get('/add-to-cart/{product}', [ProductsController::class, 'addToCart'])->name('add-cart');
	Route::get('/change-qty/{product}', [ProductsController::class,'changeQty'])->name('change_qty');
	Route::get('/remove/{id}', [ProductsController::class, 'removeFromCart'])->name('remove');
	Route::get('/emptycart', [ProductsController::class, 'emptyCart'])->name('emptyCart');

	Route::get('/order',[CartController::class, 'addToOrder'])->name('order');
	Route::get('/orderitem',[CartController::class, 'orderitem']);
	Route::get('/addorderitem',[CartController::class, 'addorderitem'])->name('addorderitem');
});