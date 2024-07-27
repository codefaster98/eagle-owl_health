<?php

namespace App\Filament\Resources\SpeakersSpeakersResource\Pages;

use App\Filament\Resources\SpeakersSpeakersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpeakersSpeakers extends ListRecords
{
    protected static string $resource = SpeakersSpeakersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
