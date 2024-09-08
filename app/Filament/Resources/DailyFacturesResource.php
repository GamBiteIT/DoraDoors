<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DailyFactures;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DailyFacturesResource\Pages;
use App\Filament\Resources\DailyFacturesResource\RelationManagers;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;

class DailyFacturesResource extends Resource
{
    protected static ?string $model = DailyFactures::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('day')->native(false)->required(),
                TextInput::make('price_in')->numeric(),
                TextInput::make('price_out')->numeric(),
                TextInput::make('description'),
                TextInput::make('price_net')->numeric()->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('day')->date()->sortable()->searchable(),
                TextColumn::make('description')->searchable(),
                TextColumn::make('price_in')->numeric()->money('OMR')->sortable()->summarize([
                    Sum::make()->label('Total Income') 
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
            'index' => Pages\ListDailyFactures::route('/'),
            'create' => Pages\CreateDailyFactures::route('/create'),
            'edit' => Pages\EditDailyFactures::route('/{record}/edit'),
        ];
    }
}
