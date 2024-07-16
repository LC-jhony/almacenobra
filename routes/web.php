<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Almacen\Categories\CreateCategory;
use App\Livewire\Almacen\ListProducts;
use App\Livewire\Almacen\Products\CreateProduct;
use App\Livewire\Almacen\Reports\Report;
use App\Livewire\Amacen\Categories\CreatCategory;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/category/create', CreateCategory::class)->name('category.create');
    Route::get('/products', ListProducts::class)->name('list.products');
    Route::get('/product/create', CreateProduct::class)->name('create.product');
    Route::get('/report', Report::class)->name('report');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
