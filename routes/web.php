<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\StokController;

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PaymentController;

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

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::resource('keranjang', KeranjangController::class);
    Route::resource('checkout', CheckoutController::class);
    Route::resource('payment', PaymentController::class);

    //get province raja ongkir
    Route::get('get-province', [CheckoutController::class, 'get_province'])->name('get-province');
    //get city raja ongkir
    Route::get('get-city', [CheckoutController::class, 'get_city'])->name('get-city');
    //get cost raja ongkir
    Route::get('get-cost', [CheckoutController::class, 'get_cost'])->name('get-cost');
});

// jetstream
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
