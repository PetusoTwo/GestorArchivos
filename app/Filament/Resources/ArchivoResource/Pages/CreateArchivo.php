<?php

namespace App\Filament\Resources\ArchivoResource\Pages;

use App\Filament\Resources\ArchivoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Filament\Forms;
use Filament\Tables;
use App\Models\Archivo;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ArchivoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use TomatoPHP\FilamentMediaManager\Form\MediaManagerInput;
use App\Filament\Resources\ArchivoResource\RelationManagers;


class CreateArchivo extends CreateRecord
{
    protected static string $resource = ArchivoResource::class;
}
