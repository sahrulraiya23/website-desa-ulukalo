<?php

namespace App\Filament\Resources\Apbdes\Pages;

use App\Filament\Resources\Apbdes\ApbdesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApbdes extends ListRecords
{
    protected static string $resource = ApbdesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
