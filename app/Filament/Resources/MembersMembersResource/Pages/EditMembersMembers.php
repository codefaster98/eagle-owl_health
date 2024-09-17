<?php

namespace App\Filament\Resources\MembersMembersResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
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
                FileUpload::make('image')
                ->required()
                ->label("image")
                ->disk('public')
                ->directory('members_members')
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
            $imagePath = $file->store('members_members', 'public');

            if ($this->record->image) {
                Storage::disk('public')->delete($this->record->image);
            }
            $this->record->update(['image' => $imagePath]);
        }
    }
}
