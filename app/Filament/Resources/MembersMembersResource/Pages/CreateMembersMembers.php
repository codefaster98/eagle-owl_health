<?php

namespace App\Filament\Resources\MembersMembersResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\MembersMembersResource;
use App\Models\Members\MembersMembersM;

class CreateMembersMembers extends CreateRecord
{
    protected static string $resource = MembersMembersResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['code'] = Self::GenerateNewCode();
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
    static public function GenerateNewCode()
    {
        $code = \Illuminate\Support\Str::random(5);
        if (MembersMembersM::where('code', $code)->exists()) {
            return Self::GenerateNewCode();
        } else {
            return $code;
        }
    }

}
