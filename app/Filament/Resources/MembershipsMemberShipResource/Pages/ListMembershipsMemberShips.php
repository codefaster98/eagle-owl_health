<?php

namespace App\Filament\Resources\MembershipsMemberShipResource\Pages;

use App\Filament\Resources\MembershipsMemberShipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMembershipsMemberShips extends ListRecords
{
    protected static string $resource = MembershipsMemberShipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
