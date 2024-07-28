<?php

namespace App\Filament\Resources\EventsEventsResource\Pages;

use App\Filament\Resources\EventsEventsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventsEvents extends ListRecords
{
    protected static string $resource = EventsEventsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
