<?php

namespace App\Filament\Resources\DayResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class FacturesRelationManager extends RelationManager
{
    protected static string $relationship = 'factures';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('days_id')
                ->relationship('day', 'day')
                ->searchable()
                ->preload()
                ->required(),
                Forms\Components\Select::make('doors_id')
                ->relationship('doors', 'ref')->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->ref} {$record->category}")
                ->searchable()
                ->preload()
                ->required(),
                TextInput::make('qte')->required()->numeric(),
                TextInput::make('total_price')->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('days_id')
            ->columns([
                TextColumn::make('day.day')->sortable()->searchable(),     
                TextColumn::make('doors.ref')->sortable()->searchable(),
                TextColumn::make('qte')->sortable()->summarize([
                    Sum::make()->label('Total')
                ]),
                TextColumn::make('total_price')->money('OMR')->sortable()->summarize([
                    Sum::make()->label('Total')
                ]),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
