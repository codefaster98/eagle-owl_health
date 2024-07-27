<?php

namespace App\Filament\Resources\MembershipsMemberShipResource\Pages;

use App\Filament\Resources\MembershipsMemberShipResource;
use App\Services\memberships\MembershipsMembershipsServices;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Form;

class EditMembershipsMemberShip extends EditRecord
{
    protected static string $resource = MembershipsMemberShipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // dd($data["list_en"]);
        foreach ($data["list_en"] ?? [] as $keyen => $en) {
            $data["list"][$keyen]["en"] = $en;
        }
        foreach ($data["list_ar"] ?? [] as $keyar => $ar) {
            $data["list"][$keyar]["ar"] = $ar;
        }
        return $data;
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {

        // $data['code'] = MembershipsMembershipsServices::GenerateNewCode();
        foreach ($data["list"] ?? [] as $key => $val) {
            if ($data["list"][$key]["ar"]) {
                $data["list_ar"][] = $data["list"][$key]["ar"];
            }
            if ($data["list"][$key]["en"]) {
                $data["list_en"][] = $data["list"][$key]["en"];
            }
        }
        // dd($data);
        return $data;
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name_ar')->required()->label("Arabic Name"),
                TextInput::make('name_en')->required()->label("English Name"),
                TextInput::make('amount')->required()->label("Amount")->numeric(),
                Repeater::make('list')->label('List Of Items')
                    ->schema([
                        TextInput::make('ar')->required()->label("Arabic"),
                        TextInput::make('en')->required()->label("English"),
                    ])
                    ->columns(2)
                    ->columnSpan(2),
            ]);
    }
}
