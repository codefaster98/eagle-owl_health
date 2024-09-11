<?php

namespace App\Filament\Resources\EventsEventsResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\FileUpload;
use App\Models\Speakers\SpeakersSpeakersM;
use App\Filament\Resources\EventsEventsResource;

class EditEventsEvents extends EditRecord
{
    protected static string $resource = EventsEventsResource::class;

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
                TextInput::make('price')->numeric()->prefix('€')->maxValue(42949672.95)->required()->label("Price"),
                TextInput::make('price_ar')->numeric()->prefix('€')->maxValue(42949672.95)->required()->label("Arabic_Price"),
                TextInput::make('date')->required()->label("Date"),
                TextInput::make('date_details')->required()->label("Date Details"),
                TextInput::make('from_time')->required()->label("From_Time"),
                TextInput::make('to_time')->required()->label("To_Time"),
                TextInput::make('location')->required()->label("location"),
                TextInput::make('date_ar')->required()->label("Arabic Date"),
                TextInput::make('date_details_ar')->required()->label("Date_Arabic Details"),
                TextInput::make('from_time_ar')->required()->label("Arabic From_Time"),
                TextInput::make('to_time_ar')->required()->label("Arabic To_Time"),
                TextInput::make('location_ar')->required()->label("Arabic_location"),
                Textarea::make('short_desc_ar')->required()->label("Arabic Short Details"),
                Textarea::make('short_desc_en')->required()->label("English Short Details"),
                Textarea::make('long_desc_ar')->required()->label("Arabic Long Details"),
                Textarea::make('long_desc_en')->required()->label("English Long Details"),
                // FileUpload::make('image')
                // ->label("image")->
                // disk('public')
                // ->directory('events_events')
                // ->visibility('public')
                // ->required(false),
                FileUpload::make('image')
                ->label('Image')
                ->disk('public')
                ->directory('events_events')
                ->imagePreviewHeight('250')
                ->nullable(),
                Select::make('Speakers')
                    ->label('Speakers')
                    ->options(SpeakersSpeakersM::all()->pluck('name_en', 'id'))
                    ->searchable()
                    ->multiple()

            ]);

    }

    // protected function handleRecordUpdate(Model $record, array $data): Model
    // {
    //     \Log::info('Updating record with data:', $data);
    //     $record->update($data);
    //     $record->Speakers()->sync($data['Speakers'] ?? []);
    //     return $record;
    // }

    protected function afterSave(): void
    {
        $data = $this->form->getState();

        // Handle image deletion
        if (!empty($data['delete_image']) && $data['delete_image'] && $this->record->image) {
            Storage::disk('public')->delete($this->record->image);
            $this->record->update(['image' => null]);
        }

        // Handle image upload
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $imagePath = $file->store('events_events', 'public');

            // Delete old image if exists
            if ($this->record->image) {
                Storage::disk('public')->delete($this->record->image);
            }

            $this->record->update(['image' => $imagePath]);
        }
    }

}
