<?php

namespace App\Filament\Resources\AparatDesas\Pages;

use App\Filament\Resources\AparatDesas\AparatDesaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAparatDesa extends CreateRecord
{
    protected static string $resource = AparatDesaResource::class;

    // Redirect ke index/list page setelah create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
