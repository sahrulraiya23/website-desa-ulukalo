<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use App\Models\ArsipSurat;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function sejarah()
    {
        return view('sejarah');
    }

    public function visiMisi()
    {
        return view('visi-misi');
    }

    public function peta()
    {
        return view('peta');
    }

    public function struktur()
    {
        return view('struktur');
    }

    public function potensi()
    {
        return view('potensi');
    }

    public function kontak()
    {
        $kontak = [
            'alamat' => 'Jl. Poros Ulukalo, Desa Ulukalo, Kec. Wawonii Utara, Kab. Konawe Kepulauan, Sulawesi Tenggara',
            'link_gmaps' => 'https://maps.app.goo.gl/xxxxxxxxx', // <-- Ganti dengan link Google Maps Anda
            'telepon' => '0852-xxxx-xxxx', // <-- Ganti dengan nomor telepon desa
            'link_wa' => 'https://wa.me/62852xxxxxxxx', // <-- Ganti dengan link WhatsApp Anda
            'email' => 'desaulukalo@gmail.com', // <-- Ganti dengan email desa
            'jam_layanan' => 'Senin – Jumat: 08.00 – 16.00 WITA<br>Sabtu – Minggu: Libur',
            'link_gmaps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.903519881326!2d122.49895031477165!3d-6.902222294998858!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d96e6d76a2b8e3b%3A0x6b8f74a2b8e3b!2sKantor%20Desa%20Ulukalo!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid' // <-- Ganti dengan link embed Google Maps Anda
        ];

        return view('kontak', compact('kontak'));
    }

    public function pemerintahan()
    {
        return view('pemerintahan');
    }

    public function surat()
    {
        $suratConfig = $this->getSuratConfig();
        $suratConfigJson = json_encode($suratConfig, JSON_UNESCAPED_UNICODE);

        return view('surat', compact('suratConfigJson'));
    }
    private function createErrorPDF($errorMessage, $jenis = '', $data = [])
    {
        $debugInfo = [
            'Error' => $errorMessage,
            'Jenis Surat' => $jenis,
            'Timestamp' => now()->format('Y-m-d H:i:s'),
            'PHP Version' => PHP_VERSION,
            'Memory Usage' => memory_get_usage(true),
            'Data Keys' => implode(', ', array_keys($data))
        ];

        $debugHtml = '<ul>';
        foreach ($debugInfo as $key => $value) {
            $debugHtml .= '<li><strong>' . htmlspecialchars($key) . ':</strong> ' . htmlspecialchars($value) . '</li>';
        }
        $debugHtml .= '</ul>';

        return '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Error Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .error { color: red; background: #ffe6e6; padding: 10px; border: 1px solid red; margin: 10px 0; }
        .debug { background: #f0f0f0; padding: 10px; margin: 10px 0; }
        ul { margin: 10px 0; }
        li { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Error dalam Pembuatan Surat</h1>
    <div class="error">
        <h3>Pesan Error:</h3>
        <p>' . htmlspecialchars($errorMessage) . '</p>
    </div>
    <div class="debug">
        <h3>Informasi Debug:</h3>
        ' . $debugHtml . '
    </div>
    <p><strong>Saran:</strong> Periksa log server untuk informasi lebih detail atau hubungi administrator sistem.</p>
</body>
</html>';
    }
    private function generateSafeFilename($jenis, $data, $suratConfig)
    {
        $jenisNama = $suratConfig['jenis'][$jenis]['nama'] ?? 'Surat';

        // Ambil nama dari data
        $nama = '';
        if (!empty($data['nama'])) {
            $nama = $data['nama'];
        } elseif (!empty($data['subjek_nama'])) {
            $nama = $data['subjek_nama'];
        }

        // Bersihkan nama
        $nama = strtolower(trim($nama));
        $nama = preg_replace('/[^a-z0-9\s]/', '', $nama);
        $nama = preg_replace('/\s+/', '-', $nama);
        $nama = substr($nama, 0, 20);

        // Ambil nomor surat
        $nomor = '';
        if (!empty($data['nomor'])) {
            $nomor = preg_replace('/[^\d]/', '', $data['nomor']);
            $nomor = substr($nomor, 0, 10);
        }

        // Generate filename
        $filename = strtolower(str_replace([' ', '/'], '-', $jenisNama));
        if ($nama) $filename .= '-' . $nama;
        if ($nomor) $filename .= '-' . $nomor;
        $filename .= '-' . date('Y-m-d');
        $filename .= '.pdf';

        // Pastikan filename valid
        $filename = preg_replace('/[^a-z0-9\-\.]/', '', $filename);
        $filename = preg_replace('/-+/', '-', $filename); // Hapus double dash

        return $filename;
    }


    public function generateSuratPdf(Request $request)
    {
        try {
            // Set error reporting untuk debugging
            error_reporting(E_ALL);
            ini_set('display_errors', 0); // Jangan tampilkan error di output

            // Log untuk debugging
            Log::info('PDF Generation started', [
                'jenis' => $request->input('jenis'),
                'memory_usage' => memory_get_usage(true),
                'memory_limit' => ini_get('memory_limit')
            ]);

            // Validasi input
            $request->validate([
                'jenis' => 'required|string|in:sku,sktm,skbb,skbm,sptjm',
                'nomor' => 'required|string',
                'tanggal' => 'required|date'
            ]);

            $jenis = $request->input('jenis');
            $data = $request->all();

            // Bersihkan data dari nilai kosong
            $data = array_filter($data, function ($value) {
                return !is_null($value) && $value !== '';
            });

            $suratConfig = $this->getSuratConfig();
            $profilDesa = $suratConfig['profilDesa'];
            $kepalaDesa = $suratConfig['kepalaDesa'];
            $camat = $suratConfig['camat'] ?? [];

            // Generate content
            $content = $this->generateSuratContent($jenis, $data, $profilDesa, $kepalaDesa, $camat);

            if (!$content || trim($content) === '') {
                throw new \Exception('Konten surat kosong untuk jenis: ' . $jenis);
            }

            // Buat HTML lengkap dengan CSS inline
            $html = $this->createPDFHTML($content);

            Log::info('Content generated', [
                'content_length' => strlen($content),
                'html_length' => strlen($html)
            ]);

            // Generate PDF dengan error handling yang ketat
            try {
                // Pastikan tidak ada output buffer yang aktif
                if (ob_get_level()) {
                    ob_end_clean();
                }

                $pdf = PDF::loadHTML($html);
                $pdf->setPaper('A4', 'portrait');

                // Set options yang aman
                $pdf->setOptions([
                    'dpi' => 150,
                    'defaultFont' => 'serif',
                    'isRemoteEnabled' => false,
                    'isHtml5ParserEnabled' => true,
                    'isPhpEnabled' => false,
                    'debugKeepTemp' => false,
                    'debugCss' => false,
                    'debugLayout' => false
                ]);

                // Generate PDF binary
                $pdfOutput = $pdf->output();

                if (empty($pdfOutput)) {
                    throw new \Exception('PDF output kosong');
                }

                $filename = $this->generateSafeFilename($jenis, $data, $suratConfig);

                // --- PERUBAHAN DIMULAI DI SINI ---

                // 1. Simpan file PDF ke storage
                $filePath = 'surat-arsip/' . $filename;
                Storage::disk('public')->put($filePath, $pdfOutput);

                // 2. Simpan data ke database
                ArsipSurat::create([
                    'jenis_surat' => $suratConfig['jenis'][$jenis]['nama'] ?? 'Tidak Diketahui',
                    'nomor_surat' => $data['nomor'] ?? 'Tidak ada nomor',
                    'nama_pemohon' => $data['nama'] ?? $data['subjek_nama'] ?? 'Tidak ada nama',
                    'data_pemohon' => json_encode($data),
                    'file_path' => $filePath,
                ]);

                // --- PERUBAHAN SELESAI ---


                Log::info('PDF generated and archived successfully', [
                    'pdf_size' => strlen($pdfOutput),
                    'file_path' => $filePath
                ]);

                // Return dengan headers yang benar
                return response($pdfOutput, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                    'Content-Length' => strlen($pdfOutput),
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0',
                    'X-Content-Type-Options' => 'nosniff'
                ]);
            } catch (\Exception $pdfError) {
                Log::error('PDF Generation Error', [
                    'error' => $pdfError->getMessage(),
                    'trace' => $pdfError->getTraceAsString(),
                    'html_preview' => substr($html, 0, 500)
                ]);

                // Jangan return JSON di sini, karena akan di-download sebagai PDF
                // Instead, buat PDF dengan pesan error
                $errorHtml = $this->createErrorPDF($pdfError->getMessage(), $jenis, $data);

                try {
                    $errorPdf = PDF::loadHTML($errorHtml);
                    $errorPdf->setPaper('A4', 'portrait');

                    return response($errorPdf->output(), 200, [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'attachment; filename="error-report.pdf"'
                    ]);
                } catch (\Exception $errorPdfError) {
                    // Last resort: return plain text error as PDF
                    $plainErrorHtml = '<!DOCTYPE html><html><body><h1>Error</h1><p>' . htmlspecialchars($pdfError->getMessage()) . '</p></body></html>';

                    try {
                        $plainPdf = PDF::loadHTML($plainErrorHtml);
                        return response($plainPdf->output(), 200, [
                            'Content-Type' => 'application/pdf',
                            'Content-Disposition' => 'attachment; filename="error.pdf"'
                        ]);
                    } catch (\Exception $lastError) {
                        // Absolute last resort
                        abort(500, 'Gagal membuat PDF: ' . $pdfError->getMessage());
                    }
                }
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error', ['errors' => $e->errors()]);

            // Return validation error sebagai PDF
            $errorHtml = $this->createErrorPDF('Validasi gagal: ' . implode(', ', $e->validator->errors()->all()), '', []);
            $errorPdf = PDF::loadHTML($errorHtml);

            return response($errorPdf->output(), 422, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="validation-error.pdf"'
            ]);
        } catch (\Exception $e) {
            Log::error('General PDF Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            // Return general error sebagai PDF
            $errorHtml = $this->createErrorPDF($e->getMessage(), '', []);

            try {
                $errorPdf = PDF::loadHTML($errorHtml);
                return response($errorPdf->output(), 500, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="system-error.pdf"'
                ]);
            } catch (\Exception $finalError) {
                abort(500, 'System Error: ' . $e->getMessage());
            }
        }
    }
    private function createPDFHTML($content)
    {
        return '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Desa</title>
    <style>
        @page {
            size: A4;
            margin: 15mm 20mm 20mm 20mm;
        }
        
        body {
            font-family: "Times New Roman", "Liberation Serif", serif;
            font-size: 12pt;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            color: #000000;
            background: #ffffff;
        }
        
        .kop-desa {
            text-align: center;
            border-bottom: 2px solid #000000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        
        .kop-desa .title {
            font-weight: bold;
            font-size: 16pt;
            letter-spacing: 0.5px;
            margin: 5px 0;
            line-height: 1.2;
        }
        
        .kop-desa .sub {
            font-weight: bold;
            font-size: 14pt;
            margin: 3px 0;
            line-height: 1.2;
        }
        
        .kop-desa .addr {
            font-size: 10pt;
            margin: 5px 0;
            line-height: 1.3;
        }
        
        .judul-surat {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
            margin: 20px 0 10px 0;
            line-height: 1.3;
        }
        
        .nomor-surat {
            text-align: center;
            margin: 5px 0 20px 0;
            font-size: 12pt;
        }
        
        p {
            margin: 10px 0;
            text-align: justify;
            text-indent: 30px;
            line-height: 1.4;
        }
        
        table {
            border-collapse: collapse;
            margin: 15px 0;
            width: 100%;
        }
        
        table td {
            padding: 2px 0;
            vertical-align: top;
            line-height: 1.4;
        }
        
        .data-table td:first-child {
            width: 180px;
            padding-right: 10px;
        }
        
        .data-table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }
        
        ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        
        ul li {
            margin: 3px 0;
            line-height: 1.4;
        }
        
        .ttd-container {
            margin-top: 40px;
            text-align: right;
        }
        
        .ttd {
            display: inline-block;
            text-align: center;
            width: 250px;
            margin: 0;
        }
        
        .ttd > div {
            margin: 5px 0;
            line-height: 1.3;
        }
        
        .ttd .nm {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }
        
        .ttd .nip {
            margin-top: 2px;
        }
        
        /* Hapus indentasi untuk elemen tertentu */
        .kop-desa p, .ttd p, table p {
            text-indent: 0;
        }
    </style>
</head>
<body>
' . $content . '
</body>
</html>';
    }
    private function generateFilename($jenis, $data, $suratConfig)
    {
        $jenisNama = $suratConfig['jenis'][$jenis]['nama'] ?? 'surat';
        $nama = strtolower(trim($data['nama'] ?? $data['subjek_nama'] ?? 'warga'));
        $nama = preg_replace('/[^a-z0-9\s]/', '', $nama);
        $nama = str_replace(' ', '-', $nama);
        $nama = substr($nama, 0, 20); // Batasi panjang nama

        $nomor = preg_replace('/[^\d]/', '', $data['nomor'] ?? '');
        $tanggal = date('Y-m-d');

        $filename = strtolower(str_replace(' ', '-', $jenisNama));
        if (!empty($nama)) $filename .= '-' . $nama;
        if (!empty($nomor)) $filename .= '-' . substr($nomor, 0, 10);
        $filename .= '-' . $tanggal . '.pdf';

        // Pastikan filename valid
        $filename = preg_replace('/[^a-z0-9\-\.]/', '', $filename);

        return $filename;
    }
    private function createDirectHTML($content)
    {
        return '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Desa</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.4;
            margin: 15mm;
            padding: 0;
            color: #000;
        }
        
        .kop-desa {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        
        .kop-desa .title {
            font-weight: bold;
            font-size: 16pt;
            letter-spacing: 0.5px;
            margin: 5px 0;
        }
        
        .kop-desa .sub {
            font-weight: bold;
            font-size: 14pt;
            margin: 3px 0;
        }
        
        .kop-desa .addr {
            font-size: 10pt;
            margin: 5px 0;
        }
        
        .judul-surat {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
            margin: 20px 0 10px 0;
        }
        
        .nomor-surat {
            text-align: center;
            margin: 5px 0 20px 0;
        }
        
        p {
            margin: 10px 0;
            text-align: justify;
            text-indent: 30px;
        }
        
        table {
            border-collapse: collapse;
            margin: 15px 0;
            width: 100%;
        }
        
        table td {
            padding: 2px 0;
            vertical-align: top;
        }
        
        .data-table td:first-child {
            width: 180px;
        }
        
        .data-table td:nth-child(2) {
            width: 20px;
        }
        
        ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        
        ul li {
            margin: 5px 0;
        }
        
        .ttd-container {
            margin-top: 40px;
            text-align: right;
        }
        
        .ttd {
            display: inline-block;
            text-align: center;
            width: 250px;
        }
        
        .ttd > div {
            margin: 5px 0;
        }
        
        .ttd .nm {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }
        
        .ttd .nip {
            margin-top: 2px;
        }
    </style>
</head>
<body>
    ' . $content . '
</body>
</html>';
    }

    public function previewSurat(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'jenis' => 'required|string|in:sku,sktm,skbb,skbm,sptjm'
            ]);

            $jenis = $request->input('jenis');
            $data = $request->all();

            $suratConfig = $this->getSuratConfig();
            $profilDesa = $suratConfig['profilDesa'];
            $kepalaDesa = $suratConfig['kepalaDesa'];
            $camat = $suratConfig['camat'] ?? [];

            // Generate content yang SAMA dengan PDF
            $content = $this->generateSuratContent($jenis, $data, $profilDesa, $kepalaDesa, $camat);

            if (!$content) {
                return response()->json(['error' => 'Jenis surat tidak valid'], 400);
            }

            // Wrap content dengan CSS yang sama seperti PDF
            $htmlWithCSS = $this->wrapContentWithCSS($content);

            return response()->json([
                'success' => true,
                'html' => $htmlWithCSS
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Surat Preview Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function wrapContentWithCSS($content)
    {
        return '
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            color: #000;
        }
        
        .kop-desa {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        
        .kop-desa .title {
            font-weight: bold;
            font-size: 16pt;
            letter-spacing: 0.5px;
            margin: 5px 0;
        }
        
        .kop-desa .sub {
            font-weight: bold;
            font-size: 14pt;
            margin: 3px 0;
        }
        
        .kop-desa .addr {
            font-size: 10pt;
            margin: 5px 0;
        }
        
        .judul-surat {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 14pt;
            margin: 20px 0 10px 0;
        }
        
        .nomor-surat {
            text-align: center;
            margin: 5px 0 20px 0;
        }
        
        p {
            margin: 10px 0;
            text-align: justify;
            text-indent: 30px;
        }
        
        table {
            border-collapse: collapse;
            margin: 15px 0;
        }
        
        table td {
            padding: 2px 0;
            vertical-align: top;
        }
        
        ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        
        ul li {
            margin: 5px 0;
        }
        
        .ttd-container {
            margin-top: 40px;
            text-align: right;
        }
        
        .ttd {
            display: inline-block;
            text-align: center;
            width: 250px;
        }
        
        .ttd > div {
            margin: 5px 0;
        }
        
        .ttd .nm {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }
        
        .ttd .nip {
            margin-top: 2px;
        }
        
        .data-table {
            width: 100%;
            margin: 15px 0;
        }
        
        .data-table td:first-child {
            width: 190px;
            padding-right: 10px;
        }
        
        .data-table td:nth-child(2) {
            width: 20px;
        }
        
        /* Styling khusus untuk web preview */
        .preview-container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            min-height: 297mm; /* A4 height */
        }
    </style>
    <div class="preview-container">
        ' . $content . '
    </div>';
    }

    /**
     * Generate content surat berdasarkan jenis
     */
    private function generateSuratContent($jenis, $data, $profilDesa, $kepalaDesa, $camat)
    {
        $kop = $this->generateKopSurat($profilDesa);

        switch ($jenis) {
            case 'sku':
                return $kop . $this->generateSKU($data, $profilDesa, $kepalaDesa);

            case 'sktm':
                return $kop . $this->generateSKTM($data, $profilDesa, $kepalaDesa);

            case 'skbb':
                return $kop . $this->generateSKBB($data, $profilDesa, $kepalaDesa, $camat);

            case 'skbm':
                return $kop . $this->generateSKBM($data, $profilDesa, $kepalaDesa);

            case 'sptjm':
                return $kop . $this->generateSPTJM($data, $profilDesa, $kepalaDesa);

            default:
                return null;
        }
    }

    /**
     * Generate kop surat
     */
    private function generateKopSurat($profilDesa)
    {
        return '
        <div class="kop-desa">
            <div class="sub">PEMERINTAH ' . strtoupper($profilDesa['kabupaten'] ?? 'KABUPATEN …') . '</div>
            <div class="sub">' . strtoupper($profilDesa['kecamatan'] ?? 'KECAMATAN …') . '</div>
            <div class="title">' . strtoupper($profilDesa['desa'] ?? 'DESA …') . '</div>
            <div class="addr">' . ($profilDesa['alamatKantor'] ?? 'Alamat Kantor …') . '</div>
        </div>';
    }

    /**
     * Generate TTD block
     */
    private function generateTtdBlock($tanggal, $desa, $kepalaDesa)
    {
        $tgl = $tanggal ? $this->formatTanggalIndonesia($tanggal) : $this->formatTanggalIndonesia(now()->format('Y-m-d'));

        return '
    <div class="ttd-container">
        <div class="ttd">
            <div>' . ($desa ?? 'Desa') . ', ' . $tgl . '</div>
            <div>KEPALA DESA</div>
            <div class="nm">' . ($kepalaDesa['nama'] ?? '[Nama Kepala Desa]') . '</div>
            <div class="nip">' . ($kepalaDesa['nip'] ?? 'NIP. -') . '</div>
        </div>
    </div>';
    }

    private function generateSKU($data, $profilDesa, $kepalaDesa)
    {
        $sektorList = '';
        if (!empty($data['sektor_pertanian'])) {
            $sektorList .= '<li>Pertanian: ' . htmlspecialchars($data['sektor_pertanian']) . '</li>';
        }
        if (!empty($data['sektor_industri'])) {
            $sektorList .= '<li>Industri: ' . htmlspecialchars($data['sektor_industri']) . '</li>';
        }
        if (!empty($data['sektor_perdagangan'])) {
            $sektorList .= '<li>Perdagangan: ' . htmlspecialchars($data['sektor_perdagangan']) . '</li>';
        }
        if (!empty($data['sektor_jasa'])) {
            $sektorList .= '<li>Jasa & Dunia Usaha: ' . htmlspecialchars($data['sektor_jasa']) . '</li>';
        }

        return '
    <div class="judul-surat">SURAT KETERANGAN USAHA</div>
    <div class="nomor-surat">Nomor: ' . htmlspecialchars($data['nomor'] ?? '-') . '</div>
    
    <p>Yang bertanda tangan di bawah ini, Kepala ' . htmlspecialchars($profilDesa['desa'] ?? 'Desa') . ', menerangkan bahwa:</p>
    
    <table class="data-table">
        <tr><td>Nama</td><td>:</td><td>' . htmlspecialchars($data['nama'] ?? '-') . '</td></tr>
        <tr><td>Tempat/Tgl Lahir</td><td>:</td><td>' . htmlspecialchars($data['ttl'] ?? '-') . '</td></tr>
        <tr><td>Alamat</td><td>:</td><td>' . htmlspecialchars($data['alamat'] ?? '-') . '</td></tr>
        <tr><td>Dusun</td><td>:</td><td>' . htmlspecialchars($data['dusun'] ?? '-') . '</td></tr>
        <tr><td>Nomor KTP</td><td>:</td><td>' . htmlspecialchars($data['nik'] ?? '-') . '</td></tr>
        <tr><td>Domisili Sejak Tahun</td><td>:</td><td>' . htmlspecialchars($data['domisili'] ?? '-') . '</td></tr>
    </table>
    
    <p>Benar yang bersangkutan memiliki/mengelola usaha pada sektor:</p>
    <ul>' . $sektorList . '</ul>
    
    <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
    
    ' . $this->generateTtdBlock($data['tanggal'] ?? null, $profilDesa['desa'] ?? null, $kepalaDesa);
    }

    /**
     * Generate Surat Keterangan Tidak Mampu
     */
    private function generateSKTM($data, $profilDesa, $kepalaDesa)
    {
        return '
        <div class="judul-surat">SURAT KETERANGAN TIDAK MAMPU</div>
        <div class="nomor-surat">Nomor: ' . ($data['nomor'] ?? '-') . '</div>
        
        <p>Yang bertanda tangan di bawah ini, Kepala ' . ($profilDesa['desa'] ?? 'Desa') . ', menerangkan bahwa:</p>
        
        <table style="width:100%;margin-left:6px">
            <tr><td style="width:190px">Nama</td><td>: ' . ($data['nama'] ?? '-') . '</td></tr>
            <tr><td>Jenis Kelamin</td><td>: ' . ($data['jk'] ?? '-') . '</td></tr>
            <tr><td>Tempat/Tgl Lahir</td><td>: ' . ($data['ttl'] ?? '-') . '</td></tr>
            <tr><td>Pekerjaan</td><td>: ' . ($data['pekerjaan'] ?? '-') . '</td></tr>
            <tr><td>Alamat</td><td>: ' . ($data['alamat'] ?? '-') . '</td></tr>
        </table>
        
        <p>Berdasarkan keterangan RT/RW setempat, yang bersangkutan benar berasal dari keluarga yang <b>tidak mampu</b>.</p>
        
        <p>Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.</p>
        
        ' . $this->generateTtdBlock($data['tanggal'] ?? null, $profilDesa['desa'] ?? null, $kepalaDesa);
    }

    /**
     * Generate Surat Keterangan Berkelakuan Baik
     */
    private function generateSKBB($data, $profilDesa, $kepalaDesa, $camat)
    {
        return '
        <div class="judul-surat">SURAT KETERANGAN BERKELAKUAN BAIK</div>
        <div class="nomor-surat">Nomor: ' . ($data['nomor'] ?? '-') . '</div>
        
        <p>Yang bertanda tangan di bawah ini:</p>
        
        <table style="width:100%;margin-left:6px">
            <tr><td style="width:190px">Nama</td><td>: ' . ($data['pen_nama'] ?? '-') . '</td></tr>
            ' . (!empty($data['pen_umur']) ? '<tr><td>Umur</td><td>: ' . $data['pen_umur'] . '</td></tr>' : '') . '
            <tr><td>Pekerjaan/Jabatan</td><td>: ' . ($data['pen_jabatan'] ?? '-') . '</td></tr>
        </table>
        
        <p>Dengan ini menerangkan bahwa:</p>
        
        <table style="width:100%;margin-left:6px">
            <tr><td style="width:190px">Nama</td><td>: ' . ($data['nama'] ?? '-') . '</td></tr>
            <tr><td>Tempat/Tgl Lahir</td><td>: ' . ($data['ttl'] ?? '-') . '</td></tr>
            <tr><td>NIK</td><td>: ' . ($data['nik'] ?? '-') . '</td></tr>
            <tr><td>Jenis Kelamin</td><td>: ' . ($data['jk'] ?? '-') . '</td></tr>
            <tr><td>Alamat</td><td>: ' . ($data['alamat'] ?? '-') . '</td></tr>
        </table>
        
        <p>Sepanjang pengetahuan kami, yang bersangkutan <b>berkelakuan baik</b> dan tidak pernah terlibat tindak pidana. Surat keterangan ini dibuat untuk keperluan: <b>' . ($data['maksud'] ?? '-') . '</b>.</p>
        
        ' . $this->generateTtdBlock($data['tanggal'] ?? null, $profilDesa['desa'] ?? null, $kepalaDesa) . '
        
        <div style="clear:both"></div>
        <div style="margin-top:40px">
            <div>Mengetahui,</div>
            <div>Camat ' . str_replace('KECAMATAN ', '', strtoupper($profilDesa['kecamatan'] ?? '...')) . '</div>
            <div style="margin-top:68px;text-decoration:underline;font-weight:700">' . ($data['camat_nama'] ?? $camat['nama'] ?? '[Nama Camat]') . '</div>
            <div>' . ($data['camat_nip'] ?? $camat['nip'] ?? 'NIP. -') . '</div>
        </div>';
    }

    /**
     * Generate Surat Keterangan Belum Menikah
     */
    private function generateSKBM($data, $profilDesa, $kepalaDesa)
    {
        return '
        <div class="judul-surat">SURAT KETERANGAN BELUM MENIKAH</div>
        <div class="nomor-surat">Nomor: ' . ($data['nomor'] ?? '-') . '</div>
        
        <p>Yang bertanda tangan di bawah ini, Kepala ' . ($profilDesa['desa'] ?? 'Desa') . ', menerangkan bahwa:</p>
        
        <table style="width:100%;margin-left:6px">
            <tr><td style="width:190px">Nama</td><td>: ' . ($data['nama'] ?? '-') . '</td></tr>
            <tr><td>Tempat/Tgl Lahir</td><td>: ' . ($data['ttl'] ?? '-') . '</td></tr>
            <tr><td>Jenis Kelamin</td><td>: ' . ($data['jk'] ?? '-') . '</td></tr>
            <tr><td>Pekerjaan</td><td>: ' . ($data['pekerjaan'] ?? '-') . '</td></tr>
            <tr><td>Agama</td><td>: ' . ($data['agama'] ?? '-') . '</td></tr>
            <tr><td>Alamat</td><td>: ' . ($data['alamat'] ?? '-') . '</td></tr>
        </table>
        
        <p>Hingga surat ini dikeluarkan, yang bersangkutan tercatat <b>belum menikah</b>.</p>
        
        <p>Demikian surat keterangan ini dibuat agar dipergunakan sebagaimana mestinya.</p>
        
        ' . $this->generateTtdBlock($data['tanggal'] ?? null, $profilDesa['desa'] ?? null, $kepalaDesa);
    }

    /**
     * Generate Surat Pernyataan Tanggung Jawab Mutlak
     */
    private function generateSPTJM($data, $profilDesa, $kepalaDesa)
    {
        return '
        <div class="judul-surat">SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK</div>
        <div class="nomor-surat">Nomor: ' . ($data['nomor'] ?? '-') . '</div>
        
        <p>Saya yang bertanda tangan di bawah ini:</p>
        
        <table style="width:100%;margin-left:6px">
            <tr><td style="width:190px">Nama</td><td>: ' . ($data['pen_nama'] ?? '-') . '</td></tr>
            <tr><td>Jabatan</td><td>: ' . ($data['pen_jabatan'] ?? '-') . '</td></tr>
            <tr><td>Alamat</td><td>: ' . ($data['pen_alamat'] ?? '-') . '</td></tr>
        </table>
        
        <p>Dengan ini menyatakan bertanggung jawab penuh atas keabsahan data berikut:</p>
        
        <table style="width:100%;margin-left:6px">
            <tr><td style="width:190px">Nama Penduduk</td><td>: ' . ($data['subjek_nama'] ?? '-') . '</td></tr>
            <tr><td>NIK</td><td>: ' . ($data['subjek_nik'] ?? '-') . '</td></tr>
            <tr><td>No. KK</td><td>: ' . ($data['subjek_nokk'] ?? '-') . '</td></tr>
        </table>
        
        <p>Apabila di kemudian hari terdapat ketidaksesuaian, saya bersedia menanggung segala akibat hukum yang timbul.</p>
        
        ' . $this->generateTtdBlock($data['tanggal'] ?? null, $profilDesa['desa'] ?? null, $kepalaDesa);
    }

    /**
     * Format tanggal ke bahasa Indonesia
     */
    private function formatTanggalIndonesia($tanggal)
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $timestamp = strtotime($tanggal);
        $hari = date('j', $timestamp);
        $bulanNama = $bulan[(int)date('n', $timestamp)];
        $tahun = date('Y', $timestamp);

        return $hari . ' ' . $bulanNama . ' ' . $tahun;
    }

    /**
     * Konfigurasi surat
     */
    private function getSuratConfig()
    {
        return [
            'profilDesa' => [
                'kabupaten' => 'KABUPATEN KOLAKA',
                'kecamatan' => 'KECAMATAN IWOIMENDAA',
                'desa' => 'DESA ULUKALO',
                'alamatKantor' => 'Jl. Trans Sulawesi, Ulukalo, Iwoimendaa, Kolaka'
            ],
            'kepalaDesa' => [
                'nama' => 'NAMA KEPALA DESA',
                'nip' => 'NIP. 123456789012345'
            ],
            'camat' => [
                'nama' => 'NAMA CAMAT IWOIMENDAA',
                'nip' => 'NIP. 987654321098765'
            ],
            'jenis' => [
                'sku' => [
                    'nama' => 'Surat Keterangan Usaha',
                    'template' => 'assets/surat/templates/sku.pdf',
                    'fields' => [
                        ['name' => 'nomor', 'label' => 'Nomor Surat', 'req' => true, 'placeholder' => 'Contoh: 470/123/DU/2025'],
                        ['name' => 'nama', 'label' => 'Nama Lengkap', 'req' => true],
                        ['name' => 'ttl', 'label' => 'Tempat/Tanggal Lahir', 'req' => true, 'placeholder' => 'Contoh: Kolaka, 12 Januari 1998'],
                        ['name' => 'alamat', 'label' => 'Alamat Lengkap', 'req' => true],
                        ['name' => 'dusun', 'label' => 'Dusun', 'req' => true, 'type' => 'select', 'options' => ['I', 'II', 'III']],
                        ['name' => 'nik', 'label' => 'NIK', 'req' => true, 'placeholder' => '16 digit'],
                        ['name' => 'domisili', 'label' => 'Domisili Sejak Tahun', 'req' => true, 'placeholder' => 'Contoh: 2017'],
                        ['name' => 'sektor_pertanian', 'label' => 'Sektor Pertanian', 'placeholder' => 'Kosongkan jika tidak ada'],
                        ['name' => 'sektor_industri', 'label' => 'Sektor Industri', 'placeholder' => 'Kosongkan jika tidak ada'],
                        ['name' => 'sektor_perdagangan', 'label' => 'Sektor Perdagangan', 'placeholder' => 'Kosongkan jika tidak ada'],
                        ['name' => 'sektor_jasa', 'label' => 'Sektor Jasa', 'placeholder' => 'Kosongkan jika tidak ada'],
                        ['name' => 'tanggal', 'label' => 'Tanggal Surat', 'type' => 'date', 'req' => true]
                    ]
                ],
                'sktm' => [
                    'nama' => 'Surat Keterangan Tidak Mampu',
                    'template' => 'assets/surat/templates/sktm.pdf',
                    'fields' => [
                        ['name' => 'nomor', 'label' => 'Nomor Surat', 'req' => true, 'placeholder' => 'Contoh: 400/045/DU/2025'],
                        ['name' => 'nama', 'label' => 'Nama Lengkap', 'req' => true],
                        ['name' => 'jk', 'label' => 'Jenis Kelamin', 'type' => 'select', 'req' => true, 'options' => ['Laki-laki', 'Perempuan']],
                        ['name' => 'ttl', 'label' => 'Tempat/Tanggal Lahir', 'req' => true],
                        ['name' => 'pekerjaan', 'label' => 'Pekerjaan', 'req' => true],
                        ['name' => 'alamat', 'label' => 'Alamat Lengkap', 'req' => true],
                        ['name' => 'tanggal', 'label' => 'Tanggal Surat', 'type' => 'date', 'req' => true]
                    ]
                ],
                'skbb' => [
                    'nama' => 'Surat Keterangan Berkelakuan Baik',
                    'template' => 'assets/surat/templates/skbb.pdf',
                    'fields' => [
                        ['name' => 'nomor', 'label' => 'Nomor Surat', 'req' => true],
                        ['name' => 'pen_nama', 'label' => 'Nama Penandatangan', 'req' => true],
                        ['name' => 'pen_umur', 'label' => 'Umur Penandatangan'],
                        ['name' => 'pen_jabatan', 'label' => 'Jabatan Penandatangan', 'req' => true],
                        ['name' => 'nama', 'label' => 'Nama Subjek', 'req' => true],
                        ['name' => 'ttl', 'label' => 'Tempat/Tanggal Lahir', 'req' => true],
                        ['name' => 'nik', 'label' => 'NIK', 'req' => true],
                        ['name' => 'jk', 'label' => 'Jenis Kelamin', 'type' => 'select', 'req' => true, 'options' => ['Laki-laki', 'Perempuan']],
                        ['name' => 'alamat', 'label' => 'Alamat', 'req' => true],
                        ['name' => 'maksud', 'label' => 'Maksud/Keperluan', 'req' => true],
                        ['name' => 'camat_nama', 'label' => 'Nama Camat'],
                        ['name' => 'camat_nip', 'label' => 'NIP Camat'],
                        ['name' => 'tanggal', 'label' => 'Tanggal Surat', 'type' => 'date', 'req' => true]
                    ]
                ],
                'skbm' => [
                    'nama' => 'Surat Keterangan Belum Menikah',
                    'template' => 'assets/surat/templates/skbm.pdf',
                    'fields' => [
                        ['name' => 'nomor', 'label' => 'Nomor Surat', 'req' => true],
                        ['name' => 'nama', 'label' => 'Nama Lengkap', 'req' => true],
                        ['name' => 'ttl', 'label' => 'Tempat/Tanggal Lahir', 'req' => true],
                        ['name' => 'jk', 'label' => 'Jenis Kelamin', 'type' => 'select', 'req' => true, 'options' => ['Laki-laki', 'Perempuan']],
                        ['name' => 'pekerjaan', 'label' => 'Pekerjaan', 'req' => true],
                        ['name' => 'agama', 'label' => 'Agama', 'type' => 'select', 'req' => true, 'options' => ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']],
                        ['name' => 'alamat', 'label' => 'Alamat Lengkap', 'req' => true],
                        ['name' => 'tanggal', 'label' => 'Tanggal Surat', 'type' => 'date', 'req' => true]
                    ]
                ],
                'sptjm' => [
                    'nama' => 'Surat Pernyataan Tanggung Jawab Mutlak',
                    'template' => 'assets/surat/templates/sptjm.pdf',
                    'fields' => [
                        ['name' => 'nomor', 'label' => 'Nomor Surat', 'req' => true],
                        ['name' => 'pen_nama', 'label' => 'Nama Penandatangan', 'req' => true],
                        ['name' => 'pen_jabatan', 'label' => 'Jabatan', 'req' => true],
                        ['name' => 'pen_alamat', 'label' => 'Alamat Penandatangan', 'req' => true],
                        ['name' => 'subjek_nama', 'label' => 'Nama Penduduk', 'req' => true],
                        ['name' => 'subjek_nik', 'label' => 'NIK', 'req' => true],
                        ['name' => 'subjek_nokk', 'label' => 'No. KK', 'req' => true],
                        ['name' => 'tanggal', 'label' => 'Tanggal Surat', 'type' => 'date', 'req' => true]
                    ]
                ]
            ]
        ];
    }
    /**
     * Test surat config untuk debugging
     */
    public function testSuratConfig()
    {
        $config = $this->getSuratConfig();
        return response()->json([
            'config' => $config,
            'dompdf_loaded' => class_exists('Barryvdh\DomPDF\Facade\Pdf'),
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time')
        ]);
    }
}
