<?php

namespace App\Filament\Resources\DoorResource\Pages;

use App\Filament\Resources\DoorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDoor extends EditRecord
{
    protected static string $resource = DoorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
