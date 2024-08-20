<?php

namespace App\Filament\Resources\FormRequestFormMResource\Pages;

use App\Filament\Resources\FormRequestFormMResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormRequestFormMS extends ListRecords
{
    protected static string $resource = FormRequestFormMResource::class;

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
