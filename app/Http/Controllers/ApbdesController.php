<?php

namespace App\Http\Controllers;

use App\Models\Apbdes;
use Illuminate\Http\Request;

class ApbdesController extends Controller
{
    /**
     * Tampilkan halaman APBDes berdasarkan tahun.
     */
    public function index(Request $request)
    {
        $tahun = $request->get('tahun', date('Y')); // default tahun sekarang
        $apbdes = Apbdes::with(['pendapatanRincian', 'belanjaRincian'])
            ->where('tahun', $tahun)
            ->first();

        // ambil daftar tahun yg tersedia
        $years = Apbdes::orderBy('tahun', 'desc')->pluck('tahun')->unique();

        return view('apbdes', compact('apbdes', 'years', 'tahun'));
    }
}
