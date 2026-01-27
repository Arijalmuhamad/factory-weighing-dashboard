<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;

// Rute untuk halaman dashboard dan data terkait
Route::get('/dashboard-page', [DashboardController::class, 'index'])->name('admin.index');

Route::get('/api/dashboard-data', [DashboardController::class, 'getDashboardData']);

// Menambahkan route root agar mengarah ke /dashboard-page
Route::get('/', function () {
    return redirect()->route('admin.index'); // Mengarahkan ke route dengan nama admin.index
});

Route::get('/data-ffb', [DataController::class, 'getDataFFB'])->name('admin.data-ffb');
Route::get('/data-sales', [DataController::class, 'getDataSales'])->name('admin.data-sales');
Route::get('/data-others', [DataController::class, 'getDataOthers'])->name('admin.data-others');
Route::get('/data-current', [DataController::class, 'getDataCurrent'])->name('admin.data-current');

// Rute untuk API data
// Route::prefix('api')->group(function () {
//     Route::get('/dashboard-data', [DashboardController::class, 'getDashboardData']);
// });

