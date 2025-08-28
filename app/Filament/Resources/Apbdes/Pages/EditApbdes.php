<?php

namespace App\Filament\Resources\Apbdes\Pages;

use App\Filament\Resources\Apbdes\ApbdesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditApbdes extends EditRecord
{
    protected static string $resource = ApbdesResource::class;

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
