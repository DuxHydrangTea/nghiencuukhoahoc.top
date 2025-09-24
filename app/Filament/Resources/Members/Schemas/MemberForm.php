<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Enums\RoleEnum;
use Storage;
class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('fullname')->required()
                ->disabled(fn ($record) => $record && $record->isProvidedAccout()),
            TextInput::make('email')->email()
                ->required()->unique(ignoreRecord: true)->disabled(fn ($record) => true),
            FileUpload::make('avatar')
                ->label('Avatar')
                ->image()
                ->disk('b2')
                ->nullable()
                ->imageEditor()
                ->imageEditorAspectRatios(['1:1'])
                ->disabled(fn ($record) => $record && $record->isProvidedAccout()),
            TextInput::make('phone')->tel()->maxLength(11)->nullable(),
            Textarea::make('description')->nullable(),
            Select::make('role')
                ->options(RoleEnum::asArray())
                ->required(),
        ]);

    }
}
