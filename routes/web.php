<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExtraImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/laravel', function () {
    return view('welcome');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/upload', [ExtraImageController::class, 'index'])->name('extra_image.index');
Route::get('/filter', [ExtraImageController::class, 'filter'])->name('extra_image.filter');
Route::post('/upload', [ExtraImageController::class, 'storeExtraImage'])->name('extra_image.upload');
Route::get('/restore/{extraImage}', [ExtraImageController::class, 'restoreExtraImage'])->name('extra_image.restore');
Route::get('/exclude/{extraImage}', [ExtraImageController::class, 'excludeExtraImage'])->name('extra_image.exclude');
