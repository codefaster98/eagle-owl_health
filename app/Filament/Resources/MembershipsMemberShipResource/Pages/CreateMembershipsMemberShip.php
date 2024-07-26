<?php

namespace App\Filament\Resources\MembershipsMemberShipResource\Pages;

use App\Filament\Resources\MembershipsMemberShipResource;
use Filament\Actions;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;

class CreateMembershipsMemberShip extends CreateRecord
{
    protected static string $resource = MembershipsMemberShipResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['code'] = auth()->id();

        return $data;
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('code')->required()->label("Code")->default(MembershipsMembershipsServices::GenerateNewCode())->unique(),
                TextInput::make('name_ar')->required()->label("Arabic Name"),
                TextInput::make('name_en')->required()->label("English Name"),
                TextInput::make('amount')->required()->label("Amount")->numeric(),
                TextInput::make('month')->name("month")->required()->label("month")->numeric(),
                Repeater::make('List Of Items')
                    ->schema([
                        TextInput::make('list_ar')->required()->label("Arabic"),
                        TextInput::make('list_en')->required()->label("English"),
                    ])
                    ->columns(2)
                    ->columnSpan(2),
            ]);
    }
}
