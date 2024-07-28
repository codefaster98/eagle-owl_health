<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventsEventsResource\Pages;
use App\Filament\Resources\EventsEventsResource\RelationManagers;
use App\Models\Events\EventsEventsM;
use App\Models\EventsEvents;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventsEventsResource extends Resource
{
    protected static ?string $model = EventsEventsM::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = "events Panel";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('title_en'),
                Tables\Columns\TextColumn::make('title_ar'),
                Tables\Columns\TextColumn::make('short_desc_en')->limit(50),
                Tables\Columns\TextColumn::make('short_desc_ar')->limit(50),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventsEvents::route('/'),
            'create' => Pages\CreateEventsEvents::route('/create'),
            'edit' => Pages\EditEventsEvents::route('/{record}/edit'),
        ];
    }
}
