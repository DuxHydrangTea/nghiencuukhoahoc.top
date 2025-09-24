<?php

namespace App\Filament\Resources\Lessons\Schemas;

use App\Enums\ColorEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('chapter_id')
                    ->label('Chapter')
                    ->relationship('chapter', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(3),

                FileUpload::make('thumbnail')
                    ->disk('b2')
                    ->label('Thumbnail')
                    ->image()
                    ->directory('lessons/thumbnails')
                    ->imageEditor()
                    ->nullable(),

                TextInput::make('icon')
                    ->label('Icon')
                    ->maxLength(255)
                    ->nullable(),

                TagsInput::make('tags')
                    ->label('Tags')
                    ->separator(',')
                    ->nullable(),

                // FileUpload::make('video_url')
                //     ->label('Video (mp4)')
                //     ->disk('public')
                //     ->directory('lessons/videos')
                //     ->acceptedFileTypes(['video/mp4'])
                //     ->maxSize(102400) // ~100MB
                //     ->nullable(),

                // FileUpload::make('slide_file')
                //     ->label('Slides (zip)')
                //     ->disk('public')
                //     ->directory('lessons/slides')
                //     ->acceptedFileTypes([
                //         'application/zip',
                //         'application/x-zip-compressed',
                //         'multipart/x-zip',
                //         'application/octet-stream',
                //         '.zip',
                //     ])
                //     ->nullable(),

                TextInput::make('duration')
                    ->label('Duration (minutes)')
                    ->numeric()
                    ->nullable(),

                Select::make('color')
                    ->label('Color')
                    ->options(ColorEnum::options())
                    ->nullable(),
            ]);
    }
}
