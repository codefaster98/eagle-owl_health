<?php

namespace App\Filament\Resources\EventsEventsResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\FileUpload;
use App\Models\Speakers\SpeakersSpeakersM;
use App\Models\Events\EventsEventSpeakersM;
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
                TextInput::make('date')->required()->label("Date"),
                TextInput::make('date_details')->required()->label("Date Details"),
                TextInput::make('from_time')->required()->label("From_Time"),
                TextInput::make('to_time')->required()->label("To_Time"),
                TextInput::make('location')->required()->label("location"),
                Textarea::make('short_desc_ar')->required()->label("Arabic Short Details"),
                Textarea::make('short_desc_en')->required()->label("English Short Details"),
                Textarea::make('long_desc_ar')->required()->label("Arabic Long Details"),
                Textarea::make('long_desc_en')->required()->label("English Long Details"),
                FileUpload::make('image')->required()->label("image")->disk('public')->directory('events_events')->deletable(true)->visibility('public') ,
                Select::make('speaker_id')
                    ->label('Speakers')
                    ->options(SpeakersSpeakersM::all()->pluck('name', 'id'))
                    ->searchable()
                    ->multiple(),
            ]);
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        // if (isset($data['image'])) {
        //     if ($record->image && Storage::disk('public')->exists($record->image)) {
        //         Storage::disk('public')->delete($record->image);
        //     }
        //     $imagePath = $data['image']->store('events_events', 'public');
        //     $record->image = $imagePath;
        // }
        if (isset($data['image'])) {
            if ($record->image && Storage::disk('public')->exists($record->image)) {
                Storage::disk('public')->delete($record->image);
            }
            $imagePath = $data['image']->store('events_events', 'public');
            $record->image = $imagePath;
        } elseif (isset($data['remove_image']) && $data['remove_image']) {
            if ($record->image && Storage::disk('public')->exists($record->image)) {
                Storage::disk('public')->delete($record->image);
            }
            $record->image = null;
        }
        $record->speakers()->sync($data['speakers'] ?? []);
        $record->save();
        return $record;
    }
}
