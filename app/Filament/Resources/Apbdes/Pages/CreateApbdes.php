<?php

namespace App\Filament\Resources\Apbdes\Pages;

use App\Filament\Resources\Apbdes\ApbdesResource;
use Filament\Resources\Pages\CreateRecord;

class CreateApbdes extends CreateRecord
{
    protected static string $resource = ApbdesResource::class;

    // Redirect ke index/list page setelah create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
