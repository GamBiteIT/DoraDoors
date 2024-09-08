<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Door;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ColorPicker;
use App\Filament\Resources\DoorResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DoorResource\RelationManagers;
use App\Filament\Resources\DoorResource\RelationManagers\FacturesdoorsRelationManager;

class DoorResource extends Resource
{
    protected static ?string $model = Door::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ref')->required()->label('Reference'),
                Forms\Components\ColorPicker::make('color')->required(),
                Forms\Components\TextInput::make('category')->required(),
                Forms\Components\TextInput::make('price')->required()->numeric(),
                Forms\Components\RichEditor::make('description')->required(),
                FileUpload::make('photo')
    ->image()
    ->imageEditor()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ref')->label('Reference')->searchable()->sortable(),
                ImageColumn::make('photo'),
                ColorColumn::make('color'),
                TextColumn::make('category'),
                TextColumn::make('price'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FacturesdoorsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoors::route('/'),
            'create' => Pages\CreateDoor::route('/create'),
            'edit' => Pages\EditDoor::route('/{record}/edit'),
        ];
    }
}
