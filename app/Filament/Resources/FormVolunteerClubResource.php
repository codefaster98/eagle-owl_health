<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormVolunteerClubResource\Pages;
use App\Models\Form\FormVolunteerClubFormM;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
;

class FormVolunteerClubResource extends Resource
{
    protected static ?string $model = FormVolunteerClubFormM::class;

    protected static ?string $modelLabel = "Volunteer-Notification";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tables\Columns\TextColumn::make('fname')->label('Name'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('phone')->label('Phone'),
                Tables\Columns\TextColumn::make('whatsapp')->label('Whatsapp'),
                Tables\Columns\TextColumn::make('age')->label('Age'),
                Tables\Columns\TextColumn::make('gender')->label('Gender'),
                Tables\Columns\TextColumn::make('education')->label('Education'),
                Tables\Columns\TextColumn::make('language')->label('language'),
                Tables\Columns\TextColumn::make('talent')->label('Talent'),
                Tables\Columns\TextColumn::make('time_available')->label('Time_Available'),
                Tables\Columns\TextColumn::make('skills')->label('Skills'),
                Tables\Columns\TextColumn::make('other_notes')->label('Other_Notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListFormVolunteerClubs::route('/'),
            // 'create' => Pages\CreateFormVolunteerClub::route('/create'),
            // 'edit' => Pages\EditFormVolunteerClub::route('/{record}/edit'),
        ];
    }
}
