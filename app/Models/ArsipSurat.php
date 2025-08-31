<?php

// app/Models/ArsipSurat.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    use HasFactory;

    protected $table = 'arsip_surat';

    protected $fillable = [
        'jenis_surat',
        'nomor_surat',
        'nama_pemohon',
        'data_pemohon',
        'file_path',
    ];

    protected $casts = [
        'data_pemohon' => 'array',
    ];
}
