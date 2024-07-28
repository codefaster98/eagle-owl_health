<?php

namespace App\Filament\Resources\MembersMembersResource\Pages;

use App\Filament\Resources\MembersMembersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMembersMembers extends ListRecords
{
    protected static string $resource = MembersMembersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
