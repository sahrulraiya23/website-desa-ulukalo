<?php

namespace App\Filament\Resources\ArsipSurats;

use App\Filament\Resources\ArsipSurats\Pages\CreateArsipSurat;
use App\Filament\Resources\ArsipSurats\Pages\EditArsipSurat;
use App\Filament\Resources\ArsipSurats\Pages\ListArsipSurats;
use App\Filament\Resources\ArsipSurats\Pages\ViewArsipSurat;
use App\Filament\Resources\ArsipSurats\Schemas\ArsipSuratForm;
use App\Filament\Resources\ArsipSurats\Schemas\ArsipSuratInfolist;
use App\Filament\Resources\ArsipSurats\Tables\ArsipSuratsTable;
use App\Models\ArsipSurat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ArsipSuratResource extends Resource
{
    protected static ?string $model = ArsipSurat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ArsipSurat';

    public static function form(Schema $schema): Schema
    {
        return ArsipSuratForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ArsipSuratInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArsipSuratsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArsipSurats::route('/'),
            'create' => CreateArsipSurat::route('/create'),
            'view' => ViewArsipSurat::route('/{record}'),
            'edit' => EditArsipSurat::route('/{record}/edit'),
        ];
    }
}
