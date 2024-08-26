<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\OrangTuaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::get('/events', [DashboardController::class, 'getEvents']);
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Santri
    Route::resource('/santri', SantriController::class)->names([
        'index' => 'santri.index',
        'create' => 'santri.create',
        'store' => 'santri.store',
        'show' => 'santri.show',
        'edit' => 'santri.edit',
        'update' => 'santri.update',
        'destroy' => 'santri.destroy',
    ]);
    Route::get('/getsantri/{id}', [SantriController::class, 'getSantri']);

    //Guru
    Route::resource('/guru', GuruController::class)->names([
        'index' => 'guru.index',
        'create' => 'guru.create',
        'store' => 'guru.store',
        'show' => 'guru.show',
        'edit' => 'guru.edit',
        'update' => 'guru.update',
        'destroy' => 'guru.destroy',
    ]);
    Route::get('/getguru/{id}', [GuruController::class, 'getGuru']);
    Route::post('/guru/notify', [GuruController::class, 'notify']);

    //Kelas
    Route::resource('/kelas', KelasController::class)->names([
        'index' => 'kelas.index',
        'create' => 'kelas.create',
        'store' => 'kelas.store',
        'show' => 'kelas.show',
        'edit' => 'kelas.edit',
        'update' => 'kelas.update',
        'destroy' => 'kelas.destroy',
    ]);
    Route::get('/getkelas/{id}', [KelasController::class, 'getKelas']);

    // Kegiatan
    Route::resource('/kegiatan', KegiatanController::class)->names([
        'index' => 'kegiatan.index',
        'create' => 'kegiatan.create',
        'store' => 'kegiatan.store',
        'show' => 'kegiatan.show',
        'edit' => 'kegiatan.edit',
        'update' => 'kegiatan.update',
        'destroy' => 'kegiatan.destroy',
    ]);

    // Absensi
    Route::resource('/absensi', AbsensiController::class)->names([
        'index' => 'absensi.index',
        'create' => 'absensi.create',
        'store' => 'absensi.store',
        'show' => 'absensi.show',
        'edit' => 'absensi.edit',
        'update' => 'absensi.update',
        'destroy' => 'absensi.destroy',
    ]);

    // Mata Pelajaran
    Route::resource('/matapelajaran', MataPelajaranController::class)->names([
        'index' => 'matapelajaran.index',
        'create' => 'matapelajaran.create',
        'store' => 'matapelajaran.store',
        'show' => 'matapelajaran.show',
        'edit' => 'matapelajaran.edit',
        'update' => 'matapelajaran.update',
        'destroy' => 'matapelajaran.destroy',
    ]);

    // Nilai
    Route::resource('/nilai', NilaiController::class)->names([
        'index' => 'nilai.index',
        'create' => 'nilai.create',
        'store' => 'nilai.store',
        'show' => 'nilai.show',
        'edit' => 'nilai.edit',
        'update' => 'nilai.update',
        'destroy' => 'nilai.destroy',
    ]);

    // Tahun Ajaran
    Route::resource('/tahunajaran', TahunAjaranController::class)->names([
        'index' => 'tahunajaran.index',
        'create' => 'tahunajaran.create',
        'store' => 'tahunajaran.store',
        'show' => 'tahunajaran.show',
        'edit' => 'tahunajaran.edit',
        'update' => 'tahunajaran.update',
        'destroy' => 'tahunajaran.destroy',
    ]);
    Route::delete('/tahunajaran/delete-all', [TahunAjaranController::class, 'deleteAll'])->name('tahunajaran.deleteAll');

    // Orang Tua
    Route::resource('/orangtua', OrangTuaController::class)->names([
        'index' => 'orangtua.index',
        'create' => 'orangtua.create',
        'store' => 'orangtua.store',
        'show' => 'orangtua.show',
        'edit' => 'orangtua.edit',
        'update' => 'orangtua.update',
        'destroy' => 'orangtua.destroy',
    ]);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';