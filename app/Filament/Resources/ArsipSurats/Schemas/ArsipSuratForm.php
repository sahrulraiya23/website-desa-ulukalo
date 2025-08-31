<?php

namespace App\Filament\Resources\ArsipSurats\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ArsipSuratForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jenis_surat')
                    ->required(),
                TextInput::make('nomor_surat')
                    ->required(),
                TextInput::make('nama_pemohon')
                    ->required(),
                Textarea::make('data_pemohon')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('file_path')
                    ->required(),
            ]);
    }
}
