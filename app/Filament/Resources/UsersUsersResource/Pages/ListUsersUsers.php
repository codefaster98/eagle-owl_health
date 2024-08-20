<?php

namespace App\Filament\Resources\UsersUsersResource\Pages;

use App\Filament\Resources\UsersUsersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsersUsers extends ListRecords
{
    protected static string $resource = UsersUsersResource::class;

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
