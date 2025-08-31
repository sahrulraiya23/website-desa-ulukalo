<?php

namespace App\Filament\Resources\ArsipSurats\Tables;

use App\Models\ArsipSurat; // <-- PERUBAHAN 1: Tambahkan 'use' statement ini


use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;

use Filament\Support\Facades\FilamentIcon;


class ArsipSuratsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('Tanggal Dibuat')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('jenis_surat')->searchable(),
                TextColumn::make('nomor_surat')->searchable(),
                TextColumn::make('nama_pemohon')->searchable()->label('Nama Pemohon'),
            ])
            ->actions([
                Action::make('Download')
                    ->url(fn(ArsipSurat $record): string => asset('storage/' . $record->file_path))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray') // ✅ pakai heroicons outline
                    ->color('success'),
                ViewAction::make(),
            ])

            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
