<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignupController;

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
Route::get('/home',[HomeController::class, 'index']);
Route::get('/signup',[SignupController::class, 'signup']);
Route::post('/usersignup',[SignupController::class, 'usersignup']);
Route::get('/login',[SignupController::class, 'login']);
Route::post('/user_authenticate',[SignupController::class, 'user_authenticate']);

Route::get('/cart',[HomeController::class, 'index']);

Route::group(['middleware' => ['isUser'], 'prefix' => 'user'], function () {

// Route::get('/home',[HomeController::class, 'index']);

});
