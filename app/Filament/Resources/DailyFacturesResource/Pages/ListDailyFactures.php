<?php

namespace App\Filament\Resources\DailyFacturesResource\Pages;

use App\Filament\Resources\DailyFacturesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyFactures extends ListRecords
{
    protected static string $resource = DailyFacturesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
