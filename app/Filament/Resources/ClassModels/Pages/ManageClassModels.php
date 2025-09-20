<?php

namespace App\Filament\Resources\ClassModels\Pages;

use App\Filament\Resources\ClassModels\ClassModelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageClassModels extends ManageRecords
{
    protected static string $resource = ClassModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
