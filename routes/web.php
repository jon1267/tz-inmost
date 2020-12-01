<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/catalog', function () {
    return view('frontend.index');
});

Route::get('/admin', function () {
    return view('admin.admin'); //dd(auth()->user());
})->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    //Route::resource('user', UserController::class)->except(['show']);
    Route::resource('product', ProductController::class)->except(['show']);
    Route::resource('category', CategoryController::class)->except(['show']);

});
