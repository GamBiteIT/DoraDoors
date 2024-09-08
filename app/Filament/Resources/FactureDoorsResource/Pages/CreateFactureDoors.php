<?php

namespace App\Filament\Resources\FactureDoorsResource\Pages;

use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\FactureDoorsResource;

class CreateFactureDoors extends CreateRecord
{
    protected static string $resource = FactureDoorsResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['price_net'] = $data['price_in']-$data['price_out'];
     
        return $data;
    }
}
