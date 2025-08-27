<?php
// app/Models/AparatDesa.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AparatDesa extends Model
{
    use HasFactory;

    protected $table = 'aparat_desa';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'urutan',
        'aktif'
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    // Accessor untuk URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return Storage::url($this->foto);
        }

        // Default avatar jika tidak ada foto
        return asset('images/default-avatar.png');
    }

    // Scope untuk aparat yang aktif
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    // Scope untuk mengurutkan berdasarkan urutan
    public function scopeUrutan($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
