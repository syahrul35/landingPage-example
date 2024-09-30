<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\ProductDetailController;
use App\Http\Controllers\Frontend\LandingController;
use App\Http\Controllers\PageContent\AboutUsController;
use App\Http\Controllers\PageContent\GalleryController;
use App\Http\Controllers\PageContent\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::resource('product', ProductDetailController::class);
Route::post('/payment/token', [ProductPaymentController::class, 'getSnapToken']);

Route::get('/dashboard', function () {
    return Inertia::render('Backend/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', fn () => Inertia::render('About'))->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('slider', SliderController::class);
    Route::resource('aboutus', AboutUsController::class);
    Route::resource('gallery', GalleryController::class);

    Route::resource('category', CategoryController::class);
    Route::resource('products', ProductController::class);

});

require __DIR__.'/auth.php';
