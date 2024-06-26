<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add-category', [App\Http\Controllers\CategoryController::class, 'add'])->name('add');
Route::post('create-category', [App\Http\Controllers\CategoryController::class, 'create'])->name('create-category');
Route::get('/edit-category/{id?}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('edit');
Route::post('/update-category', [App\Http\Controllers\CategoryController::class, 'update'])->name('update-category');
