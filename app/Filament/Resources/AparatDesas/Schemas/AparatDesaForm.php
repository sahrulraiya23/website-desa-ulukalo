<?php

namespace App\Filament\Resources\AparatDesas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class AparatDesaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('nama')
                ->required()
                ->maxLength(255)
                ->placeholder('Masukkan nama lengkap'),
            TextInput::make('jabatan')
                ->required()
                ->maxLength(255)
                ->placeholder('Contoh: Kepala Desa, Sekretaris Desa'),
            FileUpload::make('foto')
                ->label('Foto Profil')
                ->image()
                ->disk('public')
                ->directory('aparat-desa')
                ->visibility('public')
                ->imageEditor()
                ->maxSize(2048)
                ->helperText('Ukuran maksimal 2MB')
                ->columnSpanFull(),
            TextInput::make('urutan')
                ->label('Urutan Tampilan')
                ->numeric()
                ->default(1)
                ->minValue(1)
                ->helperText('Angka terkecil akan ditampilkan lebih dulu'),
            Toggle::make('aktif')
                ->label('Status Aktif')
                ->default(true)
                ->helperText('Aparat yang tidak aktif tidak akan ditampilkan di website'),
            ]);
    }
}
