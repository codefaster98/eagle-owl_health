<?php

namespace App\Filament\Resources\FormRequestContactResource\Pages;

use App\Filament\Resources\FormRequestContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormRequestContacts extends ListRecords
{
    protected static string $resource = FormRequestContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
