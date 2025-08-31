<?php

namespace App\Filament\Resources\ArsipSurats\Pages;

use App\Filament\Resources\ArsipSurats\ArsipSuratResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditArsipSurat extends EditRecord
{
    protected static string $resource = ArsipSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
