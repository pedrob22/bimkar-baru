<?php

use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\DokterController; // Jangan lupa import ini
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect()->route('login');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Group route khusus role dokter
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    // Jadwal Periksa
    Route::prefix('jadwal-periksa')->group(function () {
        Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal-periksa.index');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal-periksa.store');
        Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal-periksa.update');
    });

    // Edit dan Update Data Dokter
    Route::get('/dokter/edit', [DokterController::class, 'edit'])->name('dokter.edit');
    Route::post('/dokter/update', [DokterController::class, 'update'])->name('dokter.update');

    // obat
      Route::resource('obat', \App\Http\Controllers\Dokter\ObatController::class);
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('pasien.dashboard');

});

require __DIR__ . '/auth.php';
