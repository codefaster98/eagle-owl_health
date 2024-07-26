<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MembershipsMemberShipResource\Pages;
use App\Filament\Resources\MembershipsMemberShipResource\RelationManagers;
use App\Models\MemberShips\MemberShipsMemberShipM;
use App\Models\MembershipsMemberShip;
use App\Services\memberships\MembershipsMembershipsServices;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TagsInput;

class MembershipsMemberShipResource extends Resource
{
    protected static ?string $model = MemberShipsMemberShipM::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = "memberships Panel";
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // // Forms\Components\TextInput::make('code')->required()->label("Code")->default(MembershipsMembershipsServices::GenerateNewCode())->unique(),
                // Forms\Components\TextInput::make('name_ar')->required()->label("Arabic Name"),
                // Forms\Components\TextInput::make('name_en')->required()->label("English Name"),
                // Forms\Components\TextInput::make('amount')->required()->label("Amount")->numeric(),
                // Forms\Components\Repeater::make('List Of Items')
                //     ->schema([
                //         Forms\Components\TextInput::make('list_ar')->required()->label("Arabic"),
                //         Forms\Components\TextInput::make('list_en')->required()->label("English"),
                //     ])
                //     ->columns(2)
                //     ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en'),
                Tables\Columns\TextColumn::make('name_ar'),
                Tables\Columns\TextColumn::make('list_en'),
                Tables\Columns\TextColumn::make('list_ar'),
                Tables\Columns\TextColumn::make('amount'),
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
            'index' => Pages\ListMembershipsMemberShips::route('/'),
            'create' => Pages\CreateMembershipsMemberShip::route('/create'),
            'edit' => Pages\EditMembershipsMemberShip::route('/{record}/edit'),
        ];
    }
}
