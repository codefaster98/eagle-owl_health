<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SpeakersSpeakers;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Speakers\SpeakersSpeakersM;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SpeakersSpeakersResource\Pages;
use App\Filament\Resources\SpeakersSpeakersResource\RelationManagers;
use App\Filament\Resources\SpeakersResource\RelationManagers\EventsEventsRelationManager;
use App\Filament\Resources\EventsResource\RelationManagers\SpeakersSpeakersRelationManager;

class SpeakersSpeakersResource extends Resource
{
    protected static ?string $model = SpeakersSpeakersM::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = "Speakers Panel";

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Forms\Components\TextInput::make('name')
            //     ->required(),
            // Forms\Components\Select::make('events')
            //     ->multiple()
            //     ->relationship('events', 'name')
            //     ->preload(),
        ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('title_en'),
                Tables\Columns\TextColumn::make('title_ar'),
                Tables\Columns\TextColumn::make('name_en'),
                Tables\Columns\TextColumn::make('name_ar'),
                Tables\Columns\TextColumn::make('name_ar'),
                // Tables\Columns\TextColumn::make('code'),


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
            'index' => Pages\ListSpeakersSpeakers::route('/'),
            'create' => Pages\CreateSpeakersSpeakers::route('/create'),
            'edit' => Pages\EditSpeakersSpeakers::route('/{record}/edit'),
        ];
    }
}
