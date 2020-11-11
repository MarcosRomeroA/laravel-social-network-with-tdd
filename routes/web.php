<?php

use App\Http\Controllers\StatusesController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// php artisan cache:clear
// php artisan route:clear
// php artisan config:clear
// php artisan view:clear

Route::view('/', 'welcome')->name('home');

//php artisan route:clear //Sirve para limpiar el cache de las rutas // Requiere authentication
Route::post('statuses', [StatusesController::class, 'store'])->name('statuses.store')->middleware('auth');

Auth::routes();

// Limpiar el cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


