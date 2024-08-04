<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
