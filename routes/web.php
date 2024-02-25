<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;

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
Route::get('/redirects', [RedirectController::class, 'index'])->name('redirects.index');
Route::get('/redirects/create', [RedirectController::class, 'create'])->name('redirects.create');
Route::post('/redirects', [RedirectController::class, 'store'])->name('redirects.store');
Route::get('/redirects/{redirect}/edit', [RedirectController::class, 'edit'])->name('redirects.edit');
Route::put('/redirects/{redirect}', [RedirectController::class, 'update'])->name('redirects.update');
Route::delete('/redirects/{redirect}', [RedirectController::class, 'destroy'])->name('redirects.destroy');
