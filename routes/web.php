<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () { 
    Route::get('/dashboard', function () { 
        return view('dokter.dashboard'); 
    })->name('dokter.dashboard'); 
 
    Route::prefix('jadwal-periksa')->group(function(){ 
        Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal-periksa.index'); 
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal-periksa.store'); 
        Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal-periksa.update'); 
    }); 
});
 
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () { 
    Route::get('/dashboard', function () { 
        return view('pasien.dashboard'); 
    })->name('pasien.dashboard'); 
}); 


require __DIR__.'/auth.php';
