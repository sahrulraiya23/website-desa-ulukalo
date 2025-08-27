<?php

namespace App\Filament\Resources\AparatDesas\Pages;

use App\Filament\Resources\AparatDesas\AparatDesaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAparatDesa extends EditRecord
{
    protected static string $resource = AparatDesaResource::class;

    // Redirect ke index/list page setelah create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
