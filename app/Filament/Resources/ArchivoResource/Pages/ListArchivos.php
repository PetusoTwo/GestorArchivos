<?php

namespace App\Filament\Resources\ArchivoResource\Pages;

use App\Filament\Resources\ArchivoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArchivos extends ListRecords
{
    protected static string $resource = ArchivoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
