<?php

namespace App\Filament\Resources\FactureDoorsResource\Pages;

use App\Filament\Resources\FactureDoorsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFactureDoors extends EditRecord
{
    protected static string $resource = FactureDoorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
