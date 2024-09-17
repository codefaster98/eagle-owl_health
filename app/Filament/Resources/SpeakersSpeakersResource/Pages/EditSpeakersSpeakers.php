<?php

namespace App\Filament\Resources\SpeakersSpeakersResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\SpeakersSpeakersResource;

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
                FileUpload::make('image')
                ->label("image")
                ->disk('public')
                ->directory('speakers_speakers')
                ->imagePreviewHeight('250')
                ->nullable(),
                Checkbox::make('delete_image')
                ->label('Delete current image')
                ->default(false)
                ->helperText('Check to remove the current image.'),
            ]);
    }

    protected function afterSave(): void
    {
        $data = $this->form->getState();

        if (isset($data['delete_image']) && $data['delete_image']) {
            if ($this->record->image) {
                Storage::disk('public')->delete($this->record->image);
                $this->record->update(['image' => '']);
            }
        }
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $imagePath = $file->store('speakers_speakers', 'public');

            if ($this->record->image) {
                Storage::disk('public')->delete($this->record->image);
            }
            $this->record->update(['image' => $imagePath]);
        }
    }

}
