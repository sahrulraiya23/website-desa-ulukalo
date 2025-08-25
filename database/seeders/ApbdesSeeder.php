<?php

namespace Database\Seeders;

use App\Models\Apbdes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ApbdesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Apbdes::create([
            'tahun' => 2025,
            'pendapatan' => 1643254177,
            'belanja' => 1637476752,
            'pembiayaan_netto' => 189551792,
            'silpa_defisit' => 195329217,
        ]);
    }
}
