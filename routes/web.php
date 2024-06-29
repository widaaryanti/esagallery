<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\BarangGambarController;
use App\Http\Controllers\Admin\GaleriGambarController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('tentang', [TentangController::class, 'index'])->name('tentang');
Route::get('galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('galeri/{id}', [GaleriController::class, 'show']);
Route::get('barang', [BarangController::class, 'index'])->name('barang');
Route::get('barang/{id}', [BarangController::class, 'show']);

Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('register');
Route::match(['get', 'put'], 'profile', [ProfileController::class, 'index'])->name('profile');
Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'checkRole:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class)->names('user');
    Route::resource('kategori', KategoriController::class)->names('kategori');
    Route::resource('barang', BarangController::class)->names('barang');
    Route::resource('barang-gambar', BarangGambarController::class)->names('barang-gambar');
    Route::resource('galeri', AdminGaleriController::class)->names('galeri');
    Route::resource('galeri-gambar', GaleriGambarController::class)->names('galeri-gambar');

    Route::match(['get', 'put'], 'profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::match(['get', 'put'], 'pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
    Route::put('profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created!';
});