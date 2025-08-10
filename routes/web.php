<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PotentialController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VillagerController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\AparatController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\ProductController;




// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/potential', [PotentialController::class, 'index'])->name('potential');
Route::get('/documentation', [DocumentationController::class, 'index'])->name('documentation');
Route::get('/map', [MapController::class, 'index'])->name('map');
Route::get('/berita/{id}', [VideoController::class, 'detail'])->name('berita.detail');

Route::get('/potential', [PotentialController::class, 'index'])->name('potential');
Route::get('/detailpotensi/{id}', [PotentialController::class, 'detailPotensi'])->name('detailpotensi');
Route::get('/detailpotensi', [PotentialController::class, 'allPotensi'])->name('allpotensi');



// Public
Route::get('/Aparatur-Desa', [AparatController::class, 'public'])->name('aparat');
Route::get('/potential', [ProductController::class, 'index'])->name('potential');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/produk-desa', [ProductController::class, 'index'])->name('products.index');



// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Admin routes (protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    // Villagers management
    Route::get('/citizens', [VillagerController::class, 'index'])->name('citizens.index');
    Route::post('/citizens', [VillagerController::class, 'store'])->name('citizens.store');
    Route::put('/citizens/{villager}', [VillagerController::class, 'update'])->name('citizens.update');
    Route::delete('/citizens/{villager}', [VillagerController::class, 'destroy'])->name('citizens.destroy');

    // Videos management
   Route::get('/videos', [AdminVideoController::class, 'index'])->name('videos.index');
Route::get('/videos/create', [AdminVideoController::class, 'create'])->name('videos.create');
Route::get('/videos/{id}/edit', [AdminVideoController::class, 'edit'])->name('videos.edit');
Route::post('/videos', [AdminVideoController::class, 'store'])->name('videos.store');
Route::put('/videos/{video}', [AdminVideoController::class, 'update'])->name('videos.update');
Route::delete('/videos/{video}', [AdminVideoController::class, 'destroy'])->name('videos.destroy');

    // Product Catalog management
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');



    // Locations management
    Route::get('/locations', [AdminLocationController::class, 'index'])->name('locations.index');
    Route::post('/locations', [AdminLocationController::class, 'store'])->name('locations.store');
    Route::put('/locations/{mapLocation}', [AdminLocationController::class, 'update'])->name('locations.update');
    Route::delete('/locations/{mapLocation}', [AdminLocationController::class, 'destroy'])->name('locations.destroy');

    Route::get('/admin/aparat', [AparatController::class, 'index'])->name('aparat.index');
    Route::post('/admin/aparat', [AparatController::class, 'store'])->name('aparat.store');
    Route::post('/admin/aparat/{id}', [AparatController::class, 'update'])->name('aparat.update');
    Route::delete('/admin/aparat/{id}', [AparatController::class, 'destroy'])->name('aparat.destroy');


});
