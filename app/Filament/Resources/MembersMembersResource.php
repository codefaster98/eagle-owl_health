<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MembersMembersResource\Pages;
use App\Filament\Resources\MembersMembersResource\RelationManagers;
use App\Models\Members\MembersMembersM;
use App\Models\MembersMembers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MembersMembersResource extends Resource
{
    protected static ?string $model = MembersMembersM::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = "Members Panel";


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
                Tables\Columns\TextColumn::make('desc_en'),
                Tables\Columns\TextColumn::make('desc_ar'),
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
            'index' => Pages\ListMembersMembers::route('/'),
            'create' => Pages\CreateMembersMembers::route('/create'),
            'edit' => Pages\EditMembersMembers::route('/{record}/edit'),
        ];
    }
}
