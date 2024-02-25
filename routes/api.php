<?php
use App\Http\Controllers\RedirectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    Route::get('/redirects', [RedirectController::class, 'index']);
    Route::post('/redirects', [RedirectController::class, 'store']);
    Route::get('/redirects/{redirect}', [RedirectController::class, 'show']);
    Route::put('/redirects/{redirect}', [RedirectController::class, 'update']);
    Route::delete('/redirects/{redirect}', [RedirectController::class, 'destroy']);
});
