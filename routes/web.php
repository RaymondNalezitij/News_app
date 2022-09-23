<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'create'])
    ->name('dashboard')
    ->middleware(['auth']);
Route::post('/dashboard', [\App\Http\Controllers\DashboardController::class, 'store'])
    ->name('dashboard.store')
    ->middleware(['auth']);

Route::get('/addAdmins', [\App\Http\Controllers\AddAdminController::class, 'create'])
    ->name('addAdmins')
    ->middleware(['auth']);
Route::post('/addAdmins', [\App\Http\Controllers\AddAdminController::class, 'store'])
    ->name('addAdmins.store')
    ->middleware(['auth']);

require __DIR__ . '/auth.php';
