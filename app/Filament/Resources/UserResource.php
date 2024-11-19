<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::End;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label(__('name')),
                TextInput::make('email')->required()->unique()->label(__('email')),
                TextInput::make('password')->required()->password(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('name'))->searchable(),
                TextColumn::make('email')->label(__('email'))->searchable(),
            ])
            ->filters([
                Filter::make(__('name')),
                Filter::make(__('email')),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('admin');
    }
    /**
     * @deprecated Use `getPluralModelLabel()` instead.
     */
    public static function getPluralLabel(): ?string
    {
        return __('admins');
    }
}
