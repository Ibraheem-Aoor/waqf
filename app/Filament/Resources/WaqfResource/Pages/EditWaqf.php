<?php

namespace App\Filament\Resources\WaqfResource\Pages;

use App\Filament\Resources\WaqfResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWaqf extends EditRecord
{
    protected static string $resource = WaqfResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
