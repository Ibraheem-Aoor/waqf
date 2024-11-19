<?php

namespace App\Filament\Resources\AzkarResource\Pages;

use App\Filament\Resources\AzkarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAzkar extends EditRecord
{
    protected static string $resource = AzkarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
