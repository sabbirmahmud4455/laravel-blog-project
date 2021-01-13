<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;






//Route::view('/', 'public.home');
Route::view('/cat', 'public.category');
Route::view('/single', 'public.single');

Route::get('/',[FontendController::class, 'index'])->name('frontend.home');
Route::get('/post/{id}',[FontendController::class, 'single'])->name('frontend.single');


Route::get('/login', [LoginController::class]);




Route::group(['middleware' => ['auth']], function () {
    
//Route::view('/dashboard', 'admin.home');

Route::resource('/dashboard/category', CategoryController::class);

Route::resource('/dashboard/tag', TagController::class);

Route::resource('/dashboard/post', PostController::class);
});



Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


