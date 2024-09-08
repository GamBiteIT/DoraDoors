<?php

namespace App\Filament\Resources\DoorResource\Pages;

use App\Filament\Resources\DoorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDoors extends ListRecords
{
    protected static string $resource = DoorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
