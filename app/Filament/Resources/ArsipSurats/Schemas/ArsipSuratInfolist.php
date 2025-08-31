<?php

namespace App\Filament\Resources\ArsipSurats\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ArsipSuratInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('jenis_surat'),
                TextEntry::make('nomor_surat'),
                TextEntry::make('nama_pemohon'),
                TextEntry::make('file_path'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
