<?php

namespace App\Filament\Resources\DoorResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;

class FacturesdoorsRelationManager extends RelationManager
{
    protected static string $relationship = 'facturesdoors';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('door_id')
                ->relationship('doors', 'ref')
                ->searchable()
                ->preload()
                ->required(),
                TextInput::make('id_facture')->required(),
                DatePicker::make('day')->native(false),
                TextInput::make('price_in')->numeric(),
                TextInput::make('price_out')->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('door.ref')->sortable()->searchable(),     
                TextColumn::make('id_facture')->sortable()->searchable(),
                TextColumn::make('day')->date()->sortable()->searchable(),
                TextColumn::make('price_in')->numeric()->money('OMR')->sortable()->summarize([
                    Sum::make()->label('Total')
                ]),
                TextColumn::make('qty')->numeric()->sortable()->summarize([
                    Sum::make()->label('Total')
                ]),
            ])
            ->filters([
                //   QueryBuilder::make()->constraints([
                //     DateConstraint::make('day'),
                // ]),
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
