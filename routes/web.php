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
use App\Http\Controllers\SarprasController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserStatus;

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified', CheckUserStatus::class])->name('home');

Route::middleware(['auth', CheckUserStatus::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', CheckUserStatus::class, 'verified'])->name('dashboard');
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
    Route::get('/kelas-santri/{idKelas}', [KelasController::class, 'santriPerKelas'])->name('kelas.santriperkelas');


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
    Route::get('/getkegiatan/{id}', [KegiatanController::class, 'getKegiatan']);
    Route::get('/all-kegiatan', [KegiatanController::class, 'getAllKegiatan']);
    Route::get('/events', [DashboardController::class, 'getEvents']);
    Route::get('/log-activities', [DashboardController::class, 'logs'])->name('log-activities');

    // Absensi
    // Route::resource('/absensi', AbsensiController::class)->names([
    //     'index' => 'absensi.index',
    //     'create' => 'absensi.create',
    //     'store' => 'absensi.store',
    //     'edit' => 'absensi.edit',
    //     'show' => 'absensi.show',
    //     'update' => 'absensi.update',
    //     'destroy' => 'absensi.destroy',
    // ]);
    Route::get('/dl', [AbsensiController::class, 'generatePDF']);
    // Route::get('/absensi/{id}/santri', [AbsensiController::class, 'showAbsensiSantri'])->name('absensi.show');
    // Sarpras
    Route::resource('/sarpras', SarprasController::class)->names([
        'index' => 'sarpras.index',
        'create' => 'sarpras.create',
        'store' => 'sarpras.store',
        'show' => 'sarpras.show',
        'edit' => 'sarpras.edit',
        'update' => 'sarpras.update',
        'destroy' => 'sarpras.destroy',
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
    Route::get('/getmapel/{id}', [MataPelajaranController::class, 'getMapel']);

    // Nilai
    Route::prefix('nilai')->group(function () {
        Route::get('/', [NilaiController::class, 'index'])->name('nilai.index');
        Route::get('/kelas/{id_kelas}', [NilaiController::class, 'inputNilai'])->name('nilai.input');
        Route::post('/store', [NilaiController::class, 'store'])->name('nilai.store');
    });

    // Tahun Ajaran

    Route::prefix('pengaturan')->group(function () {
        Route::get('/', [PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::resource('tahun-ajaran', TahunAjaranController::class)->names([
            'index' => 'tahun-ajaran.index',
            'create' => 'tahun-ajaran.create',
            'store' => 'tahun-ajaran.store',
            'show' => 'tahun-ajaran.show',
            'edit' => 'tahun-ajaran.edit',
            'update' => 'tahun-ajaran.update',
            'destroy' => 'tahun-ajaran.destroy',
        ]);

        // manajemen user
        Route::resource('pengguna', UserController::class)->names([
            'index' => 'user.index',
            'create' => 'user.create',
            'store' => 'user.store',
            'show' => 'user.show',
            'edit' => 'user.edit',
            'update' => 'user.update',
            'destroy' => 'user.destroy',
        ]);
        Route::put('/pengguna/{id}/update-status', [UserController::class, 'updateStatus'])->name('user.update.status');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('absensi')->group(function () {
        Route::get('/kelas', [AbsensiController::class, 'index'])->name('absensi.index');
        Route::get('/harian/{id_kelas}', [AbsensiController::class, 'showHarian'])->name('absensi.harian');
        Route::post('/harian/store', [AbsensiController::class, 'storeHarian'])->name('absensi.harian.store');
    });
});

require __DIR__ . '/auth.php';
