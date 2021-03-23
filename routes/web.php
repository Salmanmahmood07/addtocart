<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;

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
Route::view('/test', 'test');

Route::get('/', function () {
    return view('welcome');
});	
Auth::routes();
//Admin functionality
//Route::get('/admin',[AdminController::class, 'adminlogin'])->name('adminlogin');
//Route::post('/admin_authenticate',[AdminController::class, 'admin_authenticate']);
// Route::get('/home/logout',[AdminController::class, 'adminlogout']);
//User + Admin Functionality

Route::get('/signup',[SignupController::class, 'signup']);
Route::post('/usersignup',[SignupController::class, 'usersignup']);
Route::get('/login',[SignupController::class, 'login'])->name('login');
Route::get('/logout',[SignupController::class, 'logout'])->name('logout');
//Route::post('/user_authenticate',[SignupController::class, 'user_authenticate']);

Route::group(['middleware' => ['isAdmin'], 'prefix' => 'admin'], function () {

	Route::get('/addproduct',[AdminController::class, 'addproduct'])->name('addproduct');
	Route::post('/createproduct',[AdminController::class, 'create']);
	Route::get('/showproduct',[AdminController::class, 'showproduct'])->name('showproduct');
	Route::get('/destroy/{id}',[AdminController::class, 'destroy'])->name('destroy');
	Route::get('/editproduct/{id}',[AdminController::class, 'editproduct'])->name('editproduct');
	Route::post('/updateproduct',[AdminController::class, 'updateproduct']);

});

Route::middleware(['isUser:User'])->group(function () {
	
	Route::get('/order',[OrderController::class, 'addToOrder'])->name('order');
	Route::get('/orderform',[OrderController::class, 'orderform'])->name('orderform');
	// Route::get('/addorderitem',[OrderController::class, 'addorderitem'])->name('addorderitem');
	Route::get('/orders',[OrderController::class, 'orders']);
	Route::get('/orderitems/{id}',[OrderController::class, 'orderitems'])->name('orderitems');
	
});

Route::get('/',[HomeController::class, 'index'])->name('products');
Route::get('/search',[HomeController::class, 'search'])->name('search');
Route::post('/upcart',[OrderController::class, 'store'])->name('upcart');
Route::get('/dcart/{id}',[OrderController::class, 'destroy']);

Route::get('/cart', [ProductsController::class,'cart'])->name('cart');
Route::get('/add-to-cart/{product}', [ProductsController::class, 'addToCart'])->name('add-cart');
Route::get('/change-qty/{product}', [ProductsController::class,'changeQty'])->name('change_qty');
Route::get('/remove/{id}', [ProductsController::class, 'removeFromCart'])->name('remove');
Route::get('/emptycart', [ProductsController::class, 'emptyCart'])->name('emptyCart');