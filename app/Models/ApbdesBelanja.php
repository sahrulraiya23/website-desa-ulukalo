<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApbdesBelanja extends Model
{
    use HasFactory;

    protected $table = 'apbdes_belanja';

    protected $fillable = [
        'apbdes_id',
        'bidang_kegiatan',
        'anggaran',
    ];

    public function apbdes()
    {
        return $this->belongsTo(Apbdes::class, 'apbdes_id');
    }
}
