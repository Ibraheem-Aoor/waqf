<?php

namespace App\Filament\Resources\WaqfResource\Pages;

use App\Filament\Resources\WaqfResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaqfs extends ListRecords
{
    protected static string $resource = WaqfResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
