<?php

namespace App\Filament\Resources\AzkarResource\Pages;

use App\Filament\Resources\AzkarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAzkars extends ListRecords
{
    protected static string $resource = AzkarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
