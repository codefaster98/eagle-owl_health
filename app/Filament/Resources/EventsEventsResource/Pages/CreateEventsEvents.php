<?php

namespace App\Filament\Resources\EventsEventsResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use App\Models\Events\EventsEventsM;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\EventsEventsResource;

class CreateEventsEvents extends CreateRecord
{
    protected static string $resource = EventsEventsResource::class;
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
                TextInput::make('price')->numeric()->prefix('€')->maxValue(42949672.95)->required()->label("Price"),
                TextInput::make('date')->required()->label("Date"),
                TextInput::make('from_time')->required()->label("From_Time"),
                TextInput::make('to_time')->required()->label("To_Time"),
                TextInput::make('location')->required()->label("location"),
                Textarea::make('short_desc_ar')->required()->label("Arabic Short Details"),
                Textarea::make('short_desc_en')->required()->label("English Short Details"),
                Textarea::make('long_desc_ar')->required()->label("Arabic Long Details"),
                Textarea::make('long_desc_en')->required()->label("English Long Details"),
                FileUpload::make('image')->required()->label("image")->disk('public')->directory('events_events'),
            ]);

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
