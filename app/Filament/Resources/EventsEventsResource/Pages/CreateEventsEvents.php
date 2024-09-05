<?php

namespace App\Filament\Resources\EventsEventsResource\Pages;

use Filament\Forms\Form;
use App\Models\Events\EventsEventsM;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Models\Speakers\SpeakersSpeakersM;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Events\EventsEventSpeakersM;
use App\Filament\Resources\EventsEventsResource;

class CreateEventsEvents extends CreateRecord
{
    protected static string $resource = EventsEventsResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['code'] = Self::GenerateNewCode();
        // dd($data);
        return $data;
    }
    public function form(Form $form): Form
    {
        // dd(SpeakersSpeakersM::all()->pluck('name_ar', 'id'));
        return $form
            ->schema([
                TextInput::make('title_ar')->required()->label("Arabic Title"),
                TextInput::make('title_en')->required()->label("English Title"),
                TextInput::make('price')->numeric()->prefix('€')->maxValue(42949672.95)->required()->label("Price"),
                TextInput::make('price_ar')->numeric()->prefix('€')->maxValue(42949672.95)->required()->label("Arabic_Price"),
                TextInput::make('date')->required()->label("Date"),
                TextInput::make('date_ar')->required()->label("Arabic Date"),
                TextInput::make('date_details')->required()->label("Date Details"),
                TextInput::make('date_details_ar')->required()->label("Date_Arabic Details"),
                TextInput::make('from_time')->required()->label("From_Time"),
                TextInput::make('from_time_ar')->required()->label("Arabic From_Time"),
                TextInput::make('to_time')->required()->label("To_Time"),
                TextInput::make('to_time_ar')->required()->label("Arabic To_Time"),
                TextInput::make('location')->required()->label("location"),
                TextInput::make('location_ar')->required()->label("Arabic_location"),
                Textarea::make('short_desc_ar')->required()->label("Arabic Short Details"),
                Textarea::make('short_desc_en')->required()->label("English Short Details"),
                Textarea::make('long_desc_ar')->required()->label("Arabic Long Details"),
                Textarea::make('long_desc_en')->required()->label("English Long Details"),
                FileUpload::make('image')->required()->label("image")->disk('public')->directory('events_events'),
                Select::make('Speakers')
                    ->label('Speakers')
                    ->options(SpeakersSpeakersM::whereNotNull('name_en')->pluck('name_en', 'id'))

                    ->searchable()
                    ->multiple(),

            ]);
    }
    protected function handleRecordCreation(array $data): Model
    {
        // dd($data);
        //insert the main record
        $record =  static::getModel()::create($data);
        foreach ($data["Speakers"] ?? [] as $Speaker) {
            // Create a relation
            $event_speaker = new EventsEventSpeakersM();
            $event_speaker->speakers_id = $Speaker;
            $event_speaker->events_id = $record->id;
            // Save the relation data
            $event_speaker->save();
        }
        return $record;


    }
    protected function afterSave(): void
    {
        dd($this->record);
    }
    static public function GenerateNewCode()
    {
        $code = \Illuminate\Support\Str::random(5);
        if (EventsEventsM::where('code', $code)->exists()) {
            return Self::GenerateNewCode();
        } else {
            return $code;
        }
    }
}
