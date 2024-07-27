<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpeakersSpeakersResource\Pages;
use App\Filament\Resources\SpeakersSpeakersResource\RelationManagers;
use App\Models\Speakers\SpeakersSpeakersM;
use App\Models\SpeakersSpeakers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpeakersSpeakersResource extends Resource
{
    protected static ?string $model = SpeakersSpeakersM::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = "speakers Panel";

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
                Tables\Columns\TextColumn::make('name_en'),
                Tables\Columns\TextColumn::make('name_ar'),
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
