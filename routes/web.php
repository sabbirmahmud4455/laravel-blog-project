<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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

Route::view('test', 'welcome');

Route::view('/', 'public.home');
Route::view('/cat', 'public.category');
Route::view('/single', 'public.single');
Route::view('/dashboard', 'admin.home');

Route::resource('/dashboard/category', CategoryController::class);

Route::resource('/dashboard/tag', TagController::class);

Route::resource('/dashboard/post', PostController::class);


//Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


