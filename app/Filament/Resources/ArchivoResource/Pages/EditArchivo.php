<?php

namespace App\Filament\Resources\ArchivoResource\Pages;

use App\Filament\Resources\ArchivoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArchivo extends EditRecord
{
    protected static string $resource = ArchivoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
