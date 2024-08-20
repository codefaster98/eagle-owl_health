<?php

namespace App\Filament\Resources\UsersUsersResource\Pages;

use App\Filament\Resources\UsersUsersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsersUsers extends EditRecord
{
    protected static string $resource = UsersUsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
