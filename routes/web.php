<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Almacen\Categories\CreateCategory;
use App\Livewire\Almacen\Categories\EditCategory;
use App\Livewire\Almacen\ListProducts;
use App\Livewire\Almacen\Movements\CreateMovement;
use App\Livewire\Almacen\Order\CreateOrder;
use App\Livewire\Almacen\Order\EditOrder;
use App\Livewire\Almacen\Products\CreateProduct;
use App\Livewire\Almacen\Products\EditProduct;
use App\Livewire\Almacen\Reports\Report;
use App\Livewire\Amacen\Categories\CreatCategory;
use App\Livewire\ListCategory;
use App\Livewire\ListMovement;
use App\Livewire\ListOrder;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/categories', ListCategory::class)->name('list.category');
    Route::get('/category/create', CreateCategory::class)->name('category.create');
    Route::get('/category/edit{record}', EditCategory::class)->name('category.edit');

    Route::get('/products', ListProducts::class)->name('list.products');
    Route::get('/product/create', CreateProduct::class)->name('create.product');
    Route::get('/product/edit/{}', EditProduct::class)->name('product.edit');

    Route::get('/movements', ListMovement::class)->name('list.movement');
    Route::get('/movement/create', CreateMovement::class)->name('create.movement');

    Route::get('/listorder', ListOrder::class)->name('list.order');
    Route::get('/order/create', CreateOrder::class)->name('create.order');
    Route::get('/order/edit{record}', EditOrder::class)->name('edit.order');

    Route::get('/report', Report::class)->name('report');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
