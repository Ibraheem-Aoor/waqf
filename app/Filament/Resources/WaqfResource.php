<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaqfResource\Pages;
use App\Filament\Resources\WaqfResource\RelationManagers;
use App\Models\Setting;
use App\Models\Waqf;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ColorEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Symfony\Component\Console\Input\Input;
use Str;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Webbingbrasil\FilamentCopyActions\Tables\Actions\CopyAction;
use Filament\Support\Colors\Color;


class WaqfResource extends Resource
{
    protected static ?string $model = Waqf::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 3;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('name'))
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                        // Generate slug
                        $set('slug', Str::slug($state));

                        // Get the selected sex
                        $sex = $get('sex');

                        // If sex is selected, update description
                        $settings = Setting::first();
                        $template = $settings->about_waqf_male;
                        // Replace [name] placeholder with actual name
                        if ($sex == 'female') {
                            $template = $settings->about_waqf_female;
                        }
                        $description = str_replace('{name}', $state, $template);
                        $set('description', $description);
                    }),

                ColorPicker::make('color')
                    ->label(__('color'))
                    ->required(),

                TextInput::make('slug')
                    ->label(__('slug'))
                    ->required()
                    ->hint(__('slug_hint'))
                    ->unique(Waqf::class, 'slug', ignoreRecord: true)
                    ->rules(['regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/']),

                Radio::make('sex')
                    ->label(__('sex'))
                    ->options([
                        'male' => __('male'),
                        'female' => __('female'),
                    ])
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                        $name = $get('name');

                        if ($name) {
                            $settings = Setting::first();
                            $template = $state === 'male' ?
                                $settings->about_waqf_male :
                                $settings->about_waqf_female;

                            // Replace [name] placeholder with actual name
                            $description = str_replace('{name}', $name, $template);
                            $set('description', $description);
                        }
                    }),

                MarkdownEditor::make('description')
                    ->label(__('description')),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('name'))->searchable(),
                ColorColumn::make('color')->label(__('color'))->searchable(),
                ])
                ->filters([
                Filter::make('name')->label(__('name')),
                Filter::make('color')->label(__('color')),
            ])
            ->actions([
                CopyAction::make()->copyable(fn ($record) => $record->name)->label(__('copy'))->color(Color::Emerald),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWaqfs::route('/'),
            'create' => Pages\CreateWaqf::route('/create'),
            'edit' => Pages\EditWaqf::route('/{record}/edit'),
        ];
    }
    public static function getLabel(): ?string
    {
        return __('waqf');
    }
    /**
     * @deprecated Use `getPluralModelLabel()` instead.
     */
    public static function getPluralLabel(): ?string
    {
        return __('waqfs');
    }
}
