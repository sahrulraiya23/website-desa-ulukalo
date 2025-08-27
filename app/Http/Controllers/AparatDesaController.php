<?php

namespace App\Http\Controllers;

use App\Models\AparatDesa;
use Illuminate\Http\Request;

class AparatDesaController extends Controller
{
    public function index()
    {
        $aparatDesas = AparatDesa::aktif()
            ->urutan()
            ->get();
        return view('aparat-desa', compact('aparatDesas'));
    }
}
