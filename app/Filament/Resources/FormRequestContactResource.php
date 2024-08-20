<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormRequestContactResource\Pages;
use App\Filament\Resources\FormRequestContactResource\RelationManagers;
use App\Models\Form\FormContactFormM;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormRequestContactResource extends Resource
{
    protected static ?string $model = FormContactFormM::class;
    protected static ?string $modelLabel = "Contact Notification";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name'),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->label('Phone'),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->label('Email'),
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->label('Message'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fname')->label('Name'),
                Tables\Columns\TextColumn::make('phone')->label('Phone'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('message')->label('Message'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
                'index' => Pages\ListFormRequestContacts::route('/'),
                // Commented out or remove create and edit pages
                // 'create' => Pages\CreateFormVolunteerClub::route('/create'),
                // 'edit' => Pages\EditFormVolunteerClub::route('/{record}/edit'),
            ];
        }
        public static function shouldRegisterNavigation(): bool
        {
            return true;
        }


}



