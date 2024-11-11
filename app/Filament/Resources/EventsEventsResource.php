<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\Events\EventsEventsM;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\EventsEventsResource\Pages;

class EventsEventsResource extends Resource
{
    protected static ?string $model = EventsEventsM::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = " All Events";


    public static function form(Form $form): Form
    {
        return $form
        ->schema([]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title_en'),
                Tables\Columns\TextColumn::make('title_ar'),
                Tables\Columns\TextColumn::make('short_desc_en')->limit(50),
                Tables\Columns\TextColumn::make('short_desc_ar')->limit(50),
                ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('Speakers.code')->label('Speakers'),



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
