<?php

namespace App\Filament\Resources\FormVolunteerClubResource\Pages;

use App\Filament\Resources\FormVolunteerClubResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormVolunteerClub extends EditRecord
{
    protected static string $resource = FormVolunteerClubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
