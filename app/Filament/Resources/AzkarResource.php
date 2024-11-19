<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AzkarResource\Pages;
use App\Filament\Resources\AzkarResource\RelationManagers;
use App\Models\Azkar;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AzkarResource extends Resource
{
    protected static ?string $model = Azkar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Start;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label(__('name')),
                MarkdownEditor::make('description')->required()->label(__('description')),
                FileUpload::make('image')->label(__('icon'))->required()->disk('public')->directory('azkars'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label(__('icon'))->searchable()->width(50)->height(50)->alignRight(),
                TextColumn::make('name')->label(__('name'))->searchable(),
            ])
            ->filters([
                Filter::make('name')->label(__('name')),
            ])
            ->actions([
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
            'index' => Pages\ListAzkars::route('/'),
            'create' => Pages\CreateAzkar::route('/create'),
            'edit' => Pages\EditAzkar::route('/{record}/edit'),
        ];
    }


    public static function getLabel(): ?string
    {
        return __('azkar');
    }
    /**
     * @deprecated Use `getPluralModelLabel()` instead.
     */
    public static function getPluralLabel(): ?string
    {
        return __('azkar');

    }
}
