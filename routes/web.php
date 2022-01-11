<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\KategoriController;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\KeranjangController;


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

//role admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
});

Route::resource('dashboard', DashboardController::class);
Route::resource('keranjang', KeranjangController::class);


// example template
Route::get('/', function () {
    return view('admin.example');
});

Route::get('/user', function () {
    return view('user.example');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
