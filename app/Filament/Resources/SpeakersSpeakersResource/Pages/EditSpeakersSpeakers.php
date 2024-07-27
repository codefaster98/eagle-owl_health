<?php

namespace App\Filament\Resources\SpeakersSpeakersResource\Pages;

use App\Filament\Resources\SpeakersSpeakersResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditSpeakersSpeakers extends EditRecord
{
    protected static string $resource = SpeakersSpeakersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // dd($data["list_en"]);
        // foreach ($data["list_en"] ?? [] as $keyen => $en) {
        //     $data["list"][$keyen]["en"] = $en;
        // }
        // foreach ($data["list_ar"] ?? [] as $keyar => $ar) {
        //     $data["list"][$keyar]["ar"] = $ar;
        // }
        return $data;
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {


        // dd($data);
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
                Textarea::make('short_desc_ar')->required()->label("Arabic Short Details"),
                Textarea::make('short_desc_en')->required()->label("English Short Details"),
                Textarea::make('long_desc_ar')->required()->label("Arabic Long Details"),
                Textarea::make('long_desc_en')->required()->label("English Long Details"),
                FileUpload::make('image')->required()->label("image")->disk('public')->directory('speakers_speakers')
            ]);
    }
}
