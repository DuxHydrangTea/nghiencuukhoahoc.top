<?php

namespace App\Filament\Resources\ClassSubjects;

use App\Filament\Resources\ClassSubjects\Pages\ManageClassSubjects;
use App\Models\ClassSubject;
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
use App\Enums\ColorEnum;
use Illuminate\Support\Facades\Storage;

class ClassSubjectResource extends Resource
{
    protected static ?string $model = ClassSubject::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ClassSubjects';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('Thuộc lớp')
                    ->label('Lớp')
                    ->relationship('class', 'title') // nếu có quan hệ belongsTo Class
                    ->required(),

                Select::make('subject_id')
                    ->label('Môn học')
                    ->relationship('subject', 'title') // nếu có quan hệ belongsTo Subject
                    ->required(),

                Textarea::make('description')
                    ->label('Mô tả')
                    ->rows(3)
                    ->nullable(),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->disk('b2')
                    ->directory('thumbnails')
                    ->nullable(),

                TextInput::make('icon')
                    ->label('Icon')
                    ->nullable(),

                Select::make('color')
                    ->label('Màu sắc')
                    ->options(ColorEnum::options())
                    ->required(),

                TagsInput::make('tags')
                    ->label('Tags')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ClassSubjects')
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('class.title')->searchable(),
                TextColumn::make('subject.title')->searchable(),
                ImageColumn::make('thumbnail')->disk('b2'),
                TextColumn::make('icon'),
                TextColumn::make('color')
                    ->badge()
                    ->color(fn ($state) => $state)
                    ->formatStateUsing(fn ($state) => ucfirst($state)),
                TagsColumn::make('tags'),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
                SelectFilter::make('class_id')
                    ->label('Lớp')
                    ->relationship('class', 'title'),
                SelectFilter::make('subject_id')
                    ->label('Môn học')
                    ->relationship('subject', 'title')
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
            'index' => ManageClassSubjects::route('/'),
        ];
    }
}
