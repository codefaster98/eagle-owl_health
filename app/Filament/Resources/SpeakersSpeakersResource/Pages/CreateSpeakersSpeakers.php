<?php

namespace App\Filament\Resources\SpeakersSpeakersResource\Pages;

use App\Filament\Resources\SpeakersSpeakersResource;
use App\Models\Speakers\SpeakersSpeakersM;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateSpeakersSpeakers extends CreateRecord
{
    protected static string $resource = SpeakersSpeakersResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['code'] = Self::GenerateNewCode();
        // foreach ($data["list"] ?? [] as $key => $val) {
        //     if ($data["list"][$key]["ar"]) {
        //         $data["list_ar"][] = $data["list"][$key]["ar"];
        //     }
        //     if ($data["list"][$key]["en"]) {
        //         $data["list_en"][] = $data["list"][$key]["en"];
        //     }
        // }
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
                FileUpload::make('image')->required()->label("image")->disk('public')->directory('speakers_speakers'),
            ]);
    }
    static public function GenerateNewCode()
    {
        $code = \Illuminate\Support\Str::random(5);
        if (SpeakersSpeakersM::where('code', $code)->exists()) {
            return Self::GenerateNewCode();
        } else {
            return $code;
        }
    }
}
