<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormVolunteerClubResource\Pages;
use App\Models\Form\FormVolunteerClubFormM;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class FormVolunteerClubResource extends Resource
{
    protected static ?string $model = FormVolunteerClubFormM::class;

    protected static ?string $modelLabel = "Volunteer-Notification";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form

                ->schema([
                    Forms\Components\TextInput::make('fname')
                        ->required()
                        ->label('Name'),
                    Forms\Components\TextInput::make('phone')
                        ->required()
                        ->label('Phone'),
                    Forms\Components\TextInput::make('whatsapp')
                        ->required()
                        ->label('Whatsapp'),
                    Forms\Components\TextInput::make('email')
                        ->required()
                        ->label('Email'),
                    Forms\Components\Textarea::make('age')
                        ->required()
                        ->label('Age'),
                    Forms\Components\Textarea::make('gender')
                        ->required()
                        ->label('Gender'),
                    Forms\Components\Textarea::make('education')
                        ->required()
                        ->label('Education'),
                    Forms\Components\Textarea::make('language')
                        ->required()
                        ->label('Language'),
                    Forms\Components\Textarea::make('talent')
                        ->required()
                        ->label('Talent'),
                    Forms\Components\Textarea::make('time_available')
                        ->required()
                        ->label('Time_Available'),
                    Forms\Components\Textarea::make('skills')
                        ->required()
                        ->label('Skills'),
                    Forms\Components\Textarea::make('other_notes')
                        ->required()
                        ->label('Other_Notes'),
                        Forms\Components\CheckboxList::make('interests')
                ->label('Interested in')
                ->options([
                    'interest_administration' => 'Administration',
                    'interest_field_work' => 'Field Work',
                    'interest_campaigning' => 'Campaigning',
                    'interest_volunteer_coordination' => 'Volunteer Coordination',
                    'interest_media_maintenance_gardening' => 'Media Maintenance/Gardening',
                    'interest_health_wellness_disability' => 'Health/Wellness/Disability',
                    'interest_festivals_culture' => 'Festivals/Culture',
                    'interest_other' => 'Other',
                ])
                ->columns(2)
                ->default([]),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fname')->label('Name'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('phone')->label('Phone'),
                Tables\Columns\TextColumn::make('whatsapp')->label('Whatsapp'),
                Tables\Columns\TextColumn::make('age')->label('Age'),
                Tables\Columns\TextColumn::make('gender')->label('Gender'),
                Tables\Columns\TextColumn::make('education')->label('Education'),
                Tables\Columns\TextColumn::make('language')->label('Language'),
                Tables\Columns\TextColumn::make('talent')->label('Talent'),
                Tables\Columns\TextColumn::make('time_available')->label('Time_Available'),
                Tables\Columns\TextColumn::make('skills')->label('Skills'),
                Tables\Columns\TextColumn::make('other_notes')->label('Other_Notes'),
                Tables\Columns\TextColumn::make('interests_display')
                ->label('Interested in')
                ->formatStateUsing(function (array $state) {
                    $interests = [
                        'interest_administration' => 'Administration',
                        'interest_field_work' => 'Field Work',
                        'interest_campaigning' => 'Campaigning',
                        'interest_volunteer_coordination' => 'Volunteer Coordination',
                        'interest_media_maintenance_gardening' => 'Media Maintenance/Gardening',
                        'interest_health_wellness_disability' => 'Health/Wellness/Disability',
                        'interest_festivals_culture' => 'Festivals/Culture',
                        'interest_other' => 'Other',
                    ];

                    $display = [];
                    foreach ($interests as $key => $label) {
                        if ($state[$key] ?? false) {
                            $display[] = $label;
                        }
                    }

                    return implode(', ', $display);
                }),
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
