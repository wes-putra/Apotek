<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

// auth admin
Route::middleware(['auth', 'user-access:Admin'])->group(function () {
  
    Route::get('/Admin', [HomeController::class, 'admin'])->name('admin.home');
});

// auth superuser
Route::middleware(['auth', 'user-access:Super Admin'])->group(function () {
  
    Route::get('/SuperAdmin', [HomeController::class, 'super'])->name('super.home');
});
