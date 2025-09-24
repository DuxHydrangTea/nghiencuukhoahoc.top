<?php

namespace App\Filament\Resources\Members\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Enums\RoleEnum;

class MembersTable
{
    public static function configure(Table $table): Table
    {
        return  $table->columns([
                TextColumn::make('id')->sortable(),
                ImageColumn::make('avatar')->disk('b2')->circular(),
                TextColumn::make('fullname')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('description'),
                TextColumn::make('phone'),
                TextColumn::make('role')->formatStateUsing(fn ($state) => RoleEnum::getLabel($state)),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
