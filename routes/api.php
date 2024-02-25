<?php 

use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    Route::resource('redirects', RedirectController::class)->except([
        'create', 'edit'
    ]);

    Route::get('/r/{code}', [RedirectController::class, 'redirect']);
    Route::get('/log/{code}', [RedirectController::class, 'getRedirectLogs']);
    Route::get('/redirects/{redirect}/stats', [RedirectController::class, 'getStats']);

});
