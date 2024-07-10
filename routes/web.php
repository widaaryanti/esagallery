<?php

use App\Http\Controllers\Admin\BarangController as AdminBarangController;
use App\Http\Controllers\Admin\BarangGambarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\GaleriGambarController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\TransaksiController as AdminTransaksiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('tentang', [TentangController::class, 'index'])->name('tentang');
Route::get('galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('galeri/{id}', [GaleriController::class, 'show']);
Route::get('barang', [BarangController::class, 'index'])->name('barang');
Route::get('barang/{id}', [BarangController::class, 'show']);
Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('register');
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::match(['get', 'put'], 'profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('transaksi/struk/{id}', [TransaksiController::class, 'struk'])->name('transaksi.struk');
    Route::resource('transaksi', TransaksiController::class)->names('transaksi');
    Route::resource('cart', CartController::class)->names('cart');
});

Route::middleware(['auth', 'checkRole:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class)->names('user');
    Route::resource('kategori', KategoriController::class)->names('kategori');
    Route::resource('barang', AdminBarangController::class)->names('barang');
    Route::resource('barang-gambar', BarangGambarController::class)->names('barang-gambar');
    Route::resource('galeri', AdminGaleriController::class)->names('galeri');
    Route::resource('galeri-gambar', GaleriGambarController::class)->names('galeri-gambar');
    Route::get('transaksi/struk/{id}', [AdminTransaksiController::class, 'struk'])->name('transaksi.struk');
    Route::resource('transaksi', AdminTransaksiController::class)->names('transaksi');

    Route::match(['get', 'put'], 'profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::match(['get', 'put'], 'pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
    Route::put('profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created!';
});
