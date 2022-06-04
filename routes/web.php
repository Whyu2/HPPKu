<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DasrbordController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BahanbakuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\HppController;
use App\Http\Controllers\BopController;
use App\Http\Controllers\BtklController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CetakController;
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
Route::get('/', [LoginController::class, 'login'])->name('login');
// ->middleware('guest');
Route::post('/login', [LoginController::class, 'auth'])->name('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/about', [DasrbordController::class, 'about'])->name('about');
    Route::get('/kategori', [KategoriController::class, 'home'])->name('home');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('store');
    Route::get('/kategori/edit/{id}',  [KategoriController::class, 'edit'])->name('edit');
  
    Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('updatek');
    // Route::get('/kategori/delete{id}', [KategoriController::class, 'destroy'])->name('delete');
    Route::delete('deletekategori', [KategoriController::class, 'destroy']);

    
    Route::get('/profile/{id}', [ProfileController::class, 'home'])->name('profile');
    Route::post('/profile/update/{id}',  [ProfileController::class, 'update'])->name('editp');
    Route::get('/profile/ubah_password/{id}',  [ProfileController::class, 'ubah_password'])->name('ubah_password');
    Route::post('/profile/simpan_password/{id}',  [ProfileController::class, 'simpan_password'])->name('simpan_password');

    Route::get('/bahan_baku', [BahanbakuController::class, 'home'])->name('home');
    Route::get('/bahan_baku/editb/{id}',  [BahanbakuController::class, 'edit'])->name('editb');
    Route::post('/bahan_baku/update/{id}', [BahanbakuController::class, 'update'])->name('updateb');
    // Route::get('/bahan_baku/deleteb/{id}',  [BahanbakuController::class, 'destroy'])->name('deleteb');
    Route::delete('deletebahan', [BahanbakuController::class, 'destroy']);

    Route::get('/makanan', [MakananController::class, 'home'])->name('home');
    Route::get('/makanan/editm/{id}',  [MakananController::class, 'edit'])->name('editm');
    // Route::get('/makanan/deletem/{id}',  [MakananController::class, 'destroy'])->name('deletem');
    Route::delete('deletemakanan', [MakananController::class, 'destroy']);
    Route::post('/makanan/update/{id}', [MakananController::class, 'update'])->name('updatem');

    Route::get('/hpp', [HppController::class, 'home'])->name('home');
    Route::get('/hpp/detail/{id}', [HppController::class, 'detail'])->name('detail');
    Route::delete('deletehpp', [HppController::class, 'destroy']);
    Route::middleware(['user'])->group(function () {
        Route::get('/user', [DasrbordController::class, 'homeuser'])->name('homeuser');
        
        Route::get('/bahan_baku/tambah', [BahanbakuController::class, 'create'])->name('create');
        Route::post('/bahan_baku/store', [BahanbakuController::class, 'store'])->name('store');
       
     
        Route::get('/makanan/tambah', [MakananController::class, 'create'])->name('create');
        Route::post('/makanan/store', [MakananController::class, 'store'])->name('store');
       
        Route::get('/makanan/deletem/{id}',  [MakananController::class, 'destroy'])->name('deletem');


        Route::post('/hpp/store', [HppController::class, 'store'])->name('store');
        // Route::get('/hpp/deleteh/{id}',  [HppController::class, 'destroy'])->name('deleteh');
      
        // ajax route------
        Route::post('/getmakanan', [MakananController::class, 'getmakanan'])->name('getmakanan');
        
    });   
    Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [DasrbordController::class, 'homeuser'])->name('homeuser');
    Route::get('/bop', [BopController::class, 'home'])->name('home');
    Route::post('/bop/update/{id}', [BopController::class, 'update'])->name('updatebo');

    Route::get('/btkl', [BtklController::class, 'home'])->name('home');
    Route::get('/btkl/edit/{id}',  [BtklController::class, 'edit'])->name('editbt');
    Route::post('/btkl/update/{id}', [BtklController::class, 'update'])->name('updatebt');

    Route::get('/cost', [CostController::class, 'home'])->name('home');
    Route::get('/cost/edit/{id}',  [CostController::class, 'edit'])->name('editc');
    Route::post('/cost/update/{id}', [CostController::class, 'update'])->name('updatec');

    Route::get('/waktu', [WaktuController::class, 'home'])->name('home');
    Route::get('/waktu/edit/{id}',  [WaktuController::class, 'edit'])->name('editwa');
    Route::post('/waktu/store', [WaktuController::class, 'store'])->name('store');
    Route::post('/waktu/update/{id}', [WaktuController::class, 'update'])->name('updatewa');
    Route::delete('deletewaktu', [WaktuController::class, 'destroy']);
    
    Route::get('/event', [EventController::class, 'home'])->name('home');
    Route::post('/event/store', [EventController::class, 'store'])->name('store');

    Route::get('/event/detail/{id}', [EventController::class, 'detail'])->name('detaile');

    Route::delete('deleteevent', [EventController::class, 'destroy']);

    Route::get('/hpp/detail/cetak/{id}', [HppController::class, 'cetak_hppmakanan'])->name('cetak_detail_hpp');
    Route::get('/hpp/detail/cetak_detail_hpp_pdf/{id}', [HppController::class, 'cetak_hppmakanan_pdf'])->name('cetak_detail_hpp_pdf');
    Route::get('/event/detail/cetak/{id}', [EventController::class, 'cetak_eventorder'])->name('cetak_detail_event');
    Route::get('/event/detail/cetak_detail_event_pdf/{id}', [EventController::class, 'cetak_eventorder_pdf'])->name('cetak_eventorder_pdf');

    Route::get('/cetak_hpp', [CetakController::class, 'home_cetak_hpp'])->name('home_cetak_hpp');
    Route::post('/cetak_hpp/pilih_kategori', [CetakController::class, 'home_cetak_hpp_select'])->name('home_cetak_hpp_select');;
    Route::get('/cetak_hpp/print', [CetakController::class, 'cetak_hpp'])->name('print');
    Route::get('/cetak_hpp/print/{id}', [CetakController::class, 'cetak_hpp_select'])->name('print_select');

    Route::get('/cetak_event', [CetakController::class, 'home_cetak_event'])->name('home_cetak_event');
    Route::post('/cetak_event/select', [CetakController::class, 'home_cetak_event_select'])->name('home_cetak_event_select');
    Route::get('/cetak_event/print', [CetakController::class, 'cetak_event'])->name('print_event');
    Route::post('/cetak_event/print_select', [CetakController::class, 'print_select_event'])->name('print_select_event');
    
    });   
});