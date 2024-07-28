<?php

namespace App\Filament\Resources\MembersMembersResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\MembersMembersResource;

class EditMembersMembers extends EditRecord
{
    protected static string $resource = MembersMembersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $data;
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title_ar')->required()->label("Arabic Title"),
                TextInput::make('title_en')->required()->label("English Title"),
                TextInput::make('name_ar')->required()->label("Arabic Name"),
                TextInput::make('name_en')->required()->label("English Name"),
                TextInput::make('facebook')->label("facebook"),
                TextInput::make('twitter')->label("twitter"),
                TextInput::make('website')->label("website"),
                Textarea::make('desc_ar')->required()->label("Arabic Short Details"),
                Textarea::make('desc_en')->required()->label("English Short Details"),
                FileUpload::make('image')->required()->label("image")->disk('public')->directory('members_members'),
            ]);
    }
}
