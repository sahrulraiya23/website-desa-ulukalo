<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApbdesPendapatan;

class PendapatanSeeder extends Seeder
{
    public function run(): void
    {
        ApbdesPendapatan::create([
            'apbdes_id' => 1,
            'uraian' => 'Dana Desa',
            'anggaran' => 800000000,
        ]);

        ApbdesPendapatan::create([
            'apbdes_id' => 1,
            'uraian' => 'Alokasi Dana Desa',
            'anggaran' => 600000000,
        ]);

        ApbdesPendapatan::create([
            'apbdes_id' => 1,
            'uraian' => 'Bagi Hasil Pajak',
            'anggaran' => 200000000,
        ]);

        ApbdesPendapatan::create([
            'apbdes_id' => 1,
            'uraian' => 'Pendapatan Asli Desa',
            'anggaran' => 43454177,
        ]);
    }
}
