<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApbdesController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/sejarah', 'sejarah')->name('sejarah');
    Route::get('/visi-misi', 'visiMisi')->name('visi-misi');
    Route::get('/peta', 'peta')->name('peta');
    Route::get('/struktur', 'struktur')->name('struktur');
    Route::get('/potensi', 'potensi')->name('potensi');
    Route::get('/surat', 'surat')->name('surat');
    Route::get('/kontak', 'kontak')->name('kontak');
    Route::get('/pemerintahan', 'pemerintahan')->name('pemerintahan');
    // Route::get('/apbdes', 'apbdes')->name('apbdes');
});

Route::get('/apbdes', [ApbdesController::class, 'index'])->name('apbdes.index');
