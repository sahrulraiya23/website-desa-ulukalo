<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apbdes extends Model
{
    use HasFactory;

    protected $table = 'apbdes';

    protected $fillable = [
        'tahun',
        'pendapatan',
        'belanja',
        'pembiayaan_netto',
        'silpa_defisit',
    ];

    public function pendapatanRincian()
    {
        return $this->hasMany(ApbdesPendapatan::class, 'apbdes_id');
    }

    public function belanjaRincian()
    {
        return $this->hasMany(ApbdesBelanja::class, 'apbdes_id');
    }

    // Event untuk auto-calculate
    protected static function booted()
    {
        static::saving(function ($apbdes) {
            // Hitung total pendapatan dari rincian
            $apbdes->pendapatan = $apbdes->pendapatanRincian()->sum('anggaran');

            // Hitung total belanja dari rincian
            $apbdes->belanja = $apbdes->belanjaRincian()->sum('anggaran');

            // Hitung SILPA/Defisit
            $apbdes->silpa_defisit = $apbdes->pendapatan - $apbdes->belanja + $apbdes->pembiayaan_netto;
        });

        // Update parent ketika child berubah
        ApbdesPendapatan::saved(function ($pendapatan) {
            $pendapatan->apbdes->save();
        });

        ApbdesPendapatan::deleted(function ($pendapatan) {
            $pendapatan->apbdes->save();
        });

        ApbdesBelanja::saved(function ($belanja) {
            $belanja->apbdes->save();
        });

        ApbdesBelanja::deleted(function ($belanja) {
            $belanja->apbdes->save();
        });
    }
}
