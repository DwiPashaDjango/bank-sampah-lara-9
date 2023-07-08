<?php

use Illuminate\Support\Facades\Route;

//Admin Namespace
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DataSampahController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PengumumanController;



//Controllers Namespace
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\DataTransaksiController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\CountController;
use App\Http\Controllers\Admin\GetJadwalController;
use App\Http\Controllers\Admin\PendaftaranNasabahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\TabunganController;

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

//Home
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');


// register nasabah
Route::get('/nasabah-register', [RegisterController::class, 'registerNasabah'])->name('register.nasabah');
Route::post('/nasabah-register', [RegisterController::class, 'storeRegisterNasabah'])->name('register.nasabah.store');

//data_sampah
Route::get('/data_sampah', [DataSampahController::class, 'index'])->name('data_sampah');
Route::get('/data_sampah/{data_sampah:slug}', [DataSampahController::class, 'show'])->name('data_sampah.show');

//galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/galeri{galeri:slug}', [GaleriController::class, 'show'])->name('galeri.show');

//Pengumuman
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
Route::get('/pengumuman/{pengumuman:slug}', [PengumumanController::class, 'show'])->name('pengumuman.show');

//data_transaksi
Route::get('/data_transaksi', [DataTransaksiController::class, 'index'])->name('data_transaksi');
Route::get('/data_transaksi/{data_transaksi:slug}', [DataTransaksiController::class, 'show'])->name('data_transaksi.show');

// jadwal
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');

//count
Route::get('/count', [CountController::class, 'countMonth'])->name('count');

// tabungan
Route::get('/tabungan', [TabunganController::class, 'index'])->name('tabungan.index');
Route::get('/tabungan/create', [TabunganController::class, 'create'])->name('tabungan.create');
Route::get('/tabungan/cetak', [TabunganController::class, 'cetakAll'])->name('tabungan.cetakAll');
Route::get('/tabungan/{id}', [TabunganController::class, 'show'])->name('tabungan.show');
Route::get('/tabungan/{id}/cetak', [TabunganController::class, 'cetakById'])->name('tabungan.cetakById');
Route::post('/tabungan/store', [TabunganController::class, 'store'])->name('tabungan.store');

//Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::name('admin.')->group(function () {
        Route::group(['namespace' => '\App\Http\Controllers'], function () {
            Route::get('/', [AdminController::class, 'index'])->name('index')->middleware('can:role, "admin","guest"');
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('can:role, "admin","guest"');
            Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change-password.index')->middleware('can:role, "admin","guest"');
        });

        //Resource Controller
        Route::resource('users', 'UsersController')->middleware('can:role, "admin"');
        Route::resource('admin.index', 'CountController')->middleware('can:role, "admin"');
        Route::resource('pengumuman', 'PengumumanController')->middleware('can:role, "admin"');
        Route::resource('data_transaksi', 'DataTransaksiController')->middleware('can:role, "admin"');
        Route::resource('data_sampah', 'DataSampahController')->middleware('can:role, "admin"');
        Route::resource('galeri', 'GaleriController')->middleware('can:role, "admin"');
        Route::resource('kategori-artikel', 'KategoriArtikelController');

        // pendaftaran
        Route::get('/pendaftaran', [PendaftaranNasabahController::class, 'index']);
        Route::put('/pendaftaran/{id}', [PendaftaranNasabahController::class, 'validateUser']);

        // jadwal admin
        Route::get('/jadwal', [GetJadwalController::class, 'index'])->name('jadwal.index');
        Route::get('/jadwal/{id}', [GetJadwalController::class, 'show'])->name('jadwal.show');

        // tabungan
        Route::get('/saldoUser/{id}', [TabunganController::class, 'getSaldoUser']);
        Route::get('/saldouser/{id}/cetak-resi', [TabunganController::class, 'cetak_withdrawn']);
        Route::post('/saldoUser/tarik', [TabunganController::class, 'tarikSaldo']);
    });
});
