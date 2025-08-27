<?php

namespace App\Filament\Resources\AparatDesas;

use App\Filament\Resources\AparatDesas\Pages\CreateAparatDesa;
use App\Filament\Resources\AparatDesas\Pages\EditAparatDesa;
use App\Filament\Resources\AparatDesas\Pages\ListAparatDesas;
use App\Filament\Resources\AparatDesas\Schemas\AparatDesaForm;
use App\Filament\Resources\AparatDesas\Tables\AparatDesasTable;
use App\Models\AparatDesa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AparatDesaResource extends Resource
{
    protected static ?string $model = AparatDesa::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $recordTitleAttribute = 'nama';
    protected static ?string $pluralModelLabel = 'Aparat Desa';
    protected static ?string $slug = 'aparat-desa';

    public static function form(Schema $schema): Schema
    {
        return AparatDesaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AparatDesasTable::configure($table);
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
            'index' => ListAparatDesas::route('/'),
            'create' => CreateAparatDesa::route('/create'),
            'edit' => EditAparatDesa::route('/{record}/edit'),
        ];
    }
}
