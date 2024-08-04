<?php

namespace App\Filament\Resources\FormRequestContactResource\Pages;

use App\Filament\Resources\FormRequestContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormRequestContact extends EditRecord
{
    protected static string $resource = FormRequestContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
