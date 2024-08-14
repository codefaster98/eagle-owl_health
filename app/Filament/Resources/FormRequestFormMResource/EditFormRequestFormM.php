<?php

namespace App\Filament\Resources\FormRequestFormMResource\Pages;

use App\Filament\Resources\FormRequestFormMResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormRequestFormM extends EditRecord
{
    protected static string $resource = FormRequestFormMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
