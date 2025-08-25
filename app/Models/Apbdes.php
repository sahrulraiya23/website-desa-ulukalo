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
}
