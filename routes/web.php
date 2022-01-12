<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\StokController;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\KeranjangController;
use Illuminate\Support\Facades\Auth;

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

Route::resource('kategori', KategoriController::class);
Route::post('/kategori/update', [KategoriController::class, 'updateKategori'])->name('/kategori/update');


// redirect if auth
Route::get('/', function () {

    if(Auth::user()){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin.barang.index');
        }else if(Auth::user()->role == 'user'){
            return redirect()->route('home.index');
        }else{
            return redirect()->route('home.index');
        }
    }else{
        return redirect()->route('home.index');
    }
    
});

//role admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::resource('barang', BarangController::class);
    Route::resource('stok', StokController::class);
    Route::resource('kategori', KategoriController::class);
});

//role user
Route::resource('home', DashboardController::class);
Route::resource('keranjang', KeranjangController::class);

Route::get('/auth/login', function () {
    return view('user.login');
})->name('auth.login');

Route::get('/auth/register', function () {
    return view('user.register');
})->name('auth.register');

// jetstream
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
