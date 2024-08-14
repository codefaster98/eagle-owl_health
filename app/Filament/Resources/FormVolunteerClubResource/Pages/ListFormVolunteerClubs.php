<?php

namespace App\Filament\Resources\FormVolunteerClubResource\Pages;

use App\Filament\Resources\FormVolunteerClubResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormVolunteerClubs extends ListRecords
{
    protected static string $resource = FormVolunteerClubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
