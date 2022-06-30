<?php


use App\Http\Controllers\ProductController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});
//Route::view('/','home')->name('home');

Route::resource('product',ProductController::class)->middleware('auth')
->names('product')
->parameters(['product'=>'product']);

Auth::routes(['register'=>false,'reset'=>false]); 

Route::get('/home', [ProductController::class, 'index'])->name('home');

Route::group( ['middleware'=>'auth'],function () {
    Route::get('/', [ProductController::class, 'index'])->name('home');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
