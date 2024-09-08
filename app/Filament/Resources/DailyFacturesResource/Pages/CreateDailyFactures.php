<?php

namespace App\Filament\Resources\DailyFacturesResource\Pages;

use App\Filament\Resources\DailyFacturesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDailyFactures extends CreateRecord
{
    protected static string $resource = DailyFacturesResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['price_net'] = $data['price_in']-$data['price_out'];
     
        return $data;
    }
}
