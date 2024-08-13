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
use Filament\Forms\Components\Html;

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

    // public function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             TextInput::make('title_ar')->required()->label("Arabic Title"),
    //             TextInput::make('title_en')->required()->label("English Title"),
    //             TextInput::make('price')->numeric()->prefix('€')->maxValue(42949672.95)->required()->label("Price"),
    //             TextInput::make('date')->required()->label("Date"),
    //             TextInput::make('date_details')->required()->label("Date Details"),
    //             TextInput::make('from_time')->required()->label("From_Time"),
    //             TextInput::make('to_time')->required()->label("To_Time"),
    //             TextInput::make('location')->required()->label("location"),
    //             Textarea::make('short_desc_ar')->required()->label("Arabic Short Details"),
    //             Textarea::make('short_desc_en')->required()->label("English Short Details"),
    //             Textarea::make('long_desc_ar')->required()->label("Arabic Long Details"),
    //             Textarea::make('long_desc_en')->required()->label("English Long Details"),
    //             FileUpload::make('image')->label("image")->disk('public')->directory('events_events')->visibility('public') ->required(false)

    //         ])
    //            ->Select::make('speakers')
    //             ->label('Speakers')
    //             ->options(SpeakersSpeakersM::all()->pluck('code', 'id'))
    //             ->searchable()
    //             ->multiple()
    //         ]);
    // }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title_ar')->required()->label("Arabic Title"),
                TextInput::make('title_en')->required()->label("English Title"),
                TextInput::make('price')->numeric()->prefix('€')->maxValue(42949672.95)->required()->label("Price"),
                TextInput::make('date')->required()->label("Date"),
                TextInput::make('date_details')->required()->label("Date Details"),
                TextInput::make('from_time')->required()->label("From Time"),
                TextInput::make('to_time')->required()->label("To Time"),
                TextInput::make('location')->required()->label("Location"),
                Textarea::make('short_desc_ar')->required()->label("Arabic Short Details"),
                Textarea::make('short_desc_en')->required()->label("English Short Details"),
                Textarea::make('long_desc_ar')->required()->label("Arabic Long Details"),
                Textarea::make('long_desc_en')->required()->label("English Long Details"),

                // حقل تحميل الصورة
                FileUpload::make('image')
                    ->label("Image")
                    ->disk('public')
                    ->directory('events_events')
                    ->visibility('public')
                    ->required(false),

                // عرض الصورة الحالية بجانب حقل تحميل الصورة
                Html::make('current_image')
                    ->label('Current Image')
                    ->html(function ($record) {
                        // تحقق مما إذا كان هناك صورة موجودة واظهرها
                        return $record->image
                            ? '<img src="' . asset('storage/events_events/' . $record->image) . '" alt="Current Image" style="max-width: 300px; height: auto;">'
                            : 'No image available';
                    }),
            ])
            ->schema([
                Select::make('speakers')
                    ->label('Speakers')
                    ->options(SpeakersSpeakersM::all()->pluck('code', 'id'))
                    ->searchable()
                    ->multiple()
            ]);
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        $record->speakers()->sync($data['speakers'] ?? []);
        $record->save();
        return $record;
    }
}
