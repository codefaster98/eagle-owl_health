<?php

namespace App\Filament\Resources\FormRequestContactResource\Pages;

use App\Filament\Resources\FormRequestContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormRequestContacts extends ListRecords
{
    protected static string $resource = FormRequestContactResource::class;
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
