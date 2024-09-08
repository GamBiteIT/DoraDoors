<?php

namespace App\Filament\Resources\FactureDoorsResource\Pages;

use App\Filament\Resources\FactureDoorsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFactureDoors extends ListRecords
{
    protected static string $resource = FactureDoorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
