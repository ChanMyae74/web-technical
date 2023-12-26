<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->prefix('dashboard/categories')->name('dashboard:categories:')->group(function() {
    Route::get('/', [CategoryController::class, 'index'])->name('all');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('store', [CategoryController::class, 'store'])->name('store');
    Route::get('edit/{category:category_key}', [CategoryController::class, 'edit'])->name('edit');
    Route::post('update/{category:category_key}', [CategoryController::class, 'update'])->name('update');
    Route::delete('destroy/{category:category_key}', [CategoryController::class, 'destroy'])->name('destroy');
});
    Route::middleware(['auth'])->prefix('dashboard/items')->name('dashboard:items:')->group(function() {
        Route::get('/', [ItemController::class, 'index'])->name('all');
        Route::get('/create', [ItemController::class, 'create'])->name('create');
        Route::post('store', [ItemController::class, 'store'])->name('store');
        Route::get('edit/{item:item_key}', [ItemController::class, 'edit'])->name('edit');
        Route::put('update/{item:item_key}', [ItemController::class, 'update'])->name('update');
        Route::delete('destroy/{item:item_key}', [ItemController::class, 'destroy'])->name('destroy');
    });
Route::middleware('auth')->prefix('dashboard/attachment')->group(function (){
    Route::delete('destroy/{attachment:uuid}', [\App\Http\Controllers\AttachmentController::class,'destroy'])->name('attachment.destroy');
});
