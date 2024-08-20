<?php

namespace App\Filament\Resources\FormVolunteerClubResource\Pages;

use App\Filament\Resources\FormVolunteerClubResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormVolunteerClubs extends ListRecords
{
    protected static string $resource = FormVolunteerClubResource::class;

    protected function getActions(): array
    {
        return [
            // Disable the "Create" button
        ];
    }

    protected function getTableActions(): array
    {
        return [
            // Disable the "Edit" button
        ];
    }
}
