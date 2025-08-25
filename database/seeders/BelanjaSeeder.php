<?php

namespace Database\Seeders;

use App\Models\ApbdesBelanja;
use Illuminate\Database\Seeder;

class BelanjaSeeder extends Seeder
{
    public function run(): void
    {
        ApbdesBelanja::create([
            'apbdes_id' => 1,
            'bidang_kegiatan' => 'Belanja Penyelenggaraan Pemerintahan Desa',
            'anggaran' => 700000000,
        ]);

        ApbdesBelanja::create([
            'apbdes_id' => 1,
            'bidang_kegiatan' => 'Belanja Pembangunan Desa',
            'anggaran' => 500000000,
        ]);

        ApbdesBelanja::create([
            'apbdes_id' => 1,
            'bidang_kegiatan' => 'Belanja Pembinaan Kemasyarakatan',
            'anggaran' => 200000000,
        ]);

        ApbdesBelanja::create([
            'apbdes_id' => 1,
            'bidang_kegiatan' => 'Belanja Pemberdayaan Masyarakat',
            'anggaran' => 237476752,
        ]);
    }
}
