<?php

namespace App\Filament\Resources\Subjects;

use App\Enums\ColorEnum;
use App\Filament\Resources\Subjects\Pages\ManageSubjects;
use App\Models\ClassModel;
use App\Models\Subject;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Storage;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $recordTitleAttribute = 'Subjects';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('class_id')
                ->label('Lớp học')
                ->options(ClassModel::pluck('title', 'id')) // nếu đã định nghĩa quan hệ trong model
                ->searchable()
                ->required(),
            TextInput::make('title')->required(),
            Textarea::make('description')->nullable(),
            FileUpload::make('thumbnail')
                ->label('Thumbnail')
                ->image()
                ->disk('public')
                ->nullable(),
            TextInput::make('icon')->nullable(),
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
            ->recordTitleAttribute('Subjects')
            ->columns([
                TextColumn::make('class.title')
                    ->label('Lớp học')
                    ->sortable()
                    ->searchable(),
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
                SelectFilter::make('class')
                    ->relationship('class', 'title'),
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
            'index' => ManageSubjects::route('/'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Môn học';
    }
}
