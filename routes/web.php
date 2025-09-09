<?php

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\ApbdesController;
use App\Http\Controllers\AparatDesaController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/sejarah', 'sejarah')->name('sejarah');
    Route::get('/visi-misi', 'visiMisi')->name('visi-misi');
    Route::get('/peta', 'peta')->name('peta');
    Route::get('/struktur', 'struktur')->name('struktur');
    Route::get('/potensi', 'potensi')->name('potensi');
    Route::get('/surat', 'surat')->name('surat');
    //Route::get('/kontak', 'kontak')->name('kontak');
    // Route::get('/pemerintahan', 'pemerintahan')->name('pemerintahan');
    // Route::get('/apbdes', 'apbdes')->name('apbdes');
    Route::post('/surat/preview', [HomeController::class, 'previewSurat'])->name('surat.preview');
    Route::post('/surat/pdf', [HomeController::class, 'generateSuratPdf'])->name('surat.pdf');
    Route::get('/surat/test-config', [HomeController::class, 'testSuratConfig'])->name('surat.test');
});

Route::get('/apbdes', [ApbdesController::class, 'index'])->name('apbdes.index');
Route::get('/aparat-desa', [AparatDesaController::class, 'index'])->name('aparat-desa.index');

Route::get('/debug/pdf', function () {
    return response()->json([
        'dompdf_installed' => class_exists('Barryvdh\DomPDF\Facade\Pdf'),
        'dompdf_path' => class_exists('Barryvdh\DomPDF\Facade\Pdf') ? 'OK' : 'NOT FOUND',
        'view_exists' => file_exists(resource_path('views/pdf/surat.blade.php')),
        'view_path' => resource_path('views/pdf/surat.blade.php'),
        'php_version' => PHP_VERSION,
        'memory_limit' => ini_get('memory_limit'),
        'max_execution_time' => ini_get('max_execution_time'),
        'laravel_version' => app()->version(),
        'app_debug' => config('app.debug'),
        'storage_writable' => is_writable(storage_path()),
        'logs_writable' => is_writable(storage_path('logs'))
    ]);
});

// Route untuk test PDF generation langsung
Route::get('/debug/test-pdf', function () {
    try {
        $html = '<h1>Test PDF</h1><p>This is a test PDF document.</p>';

        $pdf = PDF::loadHTML($html);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('test.pdf');
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});
