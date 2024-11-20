<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use PhpParser\Node\Stmt\Label;

class EditSetting extends EditRecord
{
    use InteractsWithRecord;
    protected static string $resource = SettingResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirect back to the same page after saving
        return static::getResource()::getUrl('edit', ['record' => 1]);
    }

    public function mount(int|string $record = 1): void
    {
        $this->record = $this->resolveRecord($record);
        $this->form->fill($this->record->toArray());
    }

    public  function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('whatsapp')->label(__('whatsapp'))->required(),
                TextInput::make('donation_link')->label(__('donation_link'))->required()->url(),
                MarkdownEditor::make('about')->required()->label(__('about')),
                MarkdownEditor::make('about_waqf_male')->required()->label(__('about_waqf_male')),
                MarkdownEditor::make('about_waqf_female')->required()->label(__('about_waqf_fmale')),
                FileUpload::make('logo')->required()->label(__('logo'))->disk('public')->directory('settings'),
            ]);
    }

}
