<?php

namespace App\Filament\Resources\Chapters;

use App\Enums\ColorEnum;
use App\Filament\Resources\Chapters\Pages\ManageChapters;
use App\Models\Chapter;
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
use Filament\Tables\Table;

class ChapterResource extends Resource
{
    protected static ?string $model = Chapter::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Chapter';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('volume_id')
                    ->label('Tạo bài học cho')
                    ->relationship('volume', 'description')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->title} - {$record->description}")
                    ->required(),

                TextInput::make('title')
                    ->label('Tiêu đề')
                    ->nullable(),

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
            ->recordTitleAttribute('Chapter')
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('volume.title'),
                TextColumn::make('volume.classSubject.subject.title'),
                TextColumn::make('volume.classSubject.class.title'),
                TextColumn::make('title')->searchable(),
                ImageColumn::make('thumbnail')->disk('b2')->circular(),
                TextColumn::make('icon'),
                TextColumn::make('color')
                    ->badge()
                    ->color(fn ($state) => $state),
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
            'index' => ManageChapters::route('/'),
        ];
    }
}
