<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApbdesPendapatan extends Model
{
    use HasFactory;

    protected $table = 'apbdes_pendapatan';

    protected $fillable = [
        'apbdes_id',
        'uraian',
        'anggaran',
    ];

    public function apbdes()
    {
        return $this->belongsTo(Apbdes::class, 'apbdes_id');
    }
}
