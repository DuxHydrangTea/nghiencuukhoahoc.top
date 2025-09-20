<?php

namespace App\Filament\Resources\ClassModels;

use App\Filament\Resources\ClassModels\Pages\ManageClassModels;
use App\Models\ClassModel;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Enums\ColorEnum;
use Storage;

class ClassModelResource extends Resource
{
    protected static ?string $model = ClassModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $recordTitleAttribute = 'classes';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')->required(),
            Textarea::make('description')->nullable(),
            FileUpload::make('thumbnail')
                ->label('Thumbnail')
                ->image()
                ->disk('public')
                ->nullable(),
            TextInput::make('icon')->nullable(),
            TextInput::make('slogan')->nullable(),
            Select::make('color')
                ->label('Màu sắc')
                ->options(ColorEnum::options())
                ->required(),
            TagsInput::make('tags')->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('classes')
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')->searchable(),
                ImageColumn::make('thumbnail')->circular(),
                TextColumn::make('icon'),
                TextColumn::make('slogan'),
                TextColumn::make('color')
                    ->badge()
                    ->color(fn ($state) => $state)
                    ->formatStateUsing(fn ($state) => ucfirst($state)),
                TagsColumn::make('tags'),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageClassModels::route('/'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return 'Lớp học';
    }
}
