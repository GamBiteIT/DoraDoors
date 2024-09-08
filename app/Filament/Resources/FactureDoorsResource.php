<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Door;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\FactureDoors;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FactureDoorsResource\Pages;
use App\Filament\Resources\FactureDoorsResource\RelationManagers;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;

class FactureDoorsResource extends Resource
{
    protected static ?string $model = FactureDoors::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('door_id')
                ->relationship('doors', 'ref')
                ->searchable()
                ->preload()->required(),
                TextInput::make('id_facture')->required(),
                DatePicker::make('day')->native(false)->required(),
                TextInput::make('price_in')->numeric()->label('Total'),
                TextInput::make('qty')->numeric(),
                TextInput::make('price_out')->numeric(),
                TextInput::make('description'),
                TextInput::make('price_net')->numeric()->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('door.ref')->sortable()->searchable(),     
                TextColumn::make('id_facture')->sortable()->searchable(),
                TextColumn::make('day')->date()->sortable()->searchable(),
                TextColumn::make('price_in')->numeric()->money('OMR')->sortable()->summarize([
                    Sum::make()->label('Total Income') 
                ]),
                TextColumn::make('qty')->numeric()->sortable()->summarize([
                    Sum::make()->label('Total QTY')
                ]),
                TextColumn::make('price_out')->numeric()->money('OMR')->sortable()->summarize([
                    Sum::make()->label('Total Outcome') 
                ]),
                TextColumn::make('price_net')->numeric()->money('OMR')->sortable()->summarize([
                    Sum::make()->label('Total Net') 
                ]),
            
            ])
            ->filters([
                QueryBuilder::make()->constraints([
                    DateConstraint::make('day'),
                    SelectConstraint::make('door_id')->options(Door::all()->pluck('ref', 'id')),
                ]),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFactureDoors::route('/'),
            'create' => Pages\CreateFactureDoors::route('/create'),
            'edit' => Pages\EditFactureDoors::route('/{record}/edit'),
        ];
    }
}
