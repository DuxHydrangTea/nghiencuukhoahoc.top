<?php

namespace App\Filament\Resources\ClassSubjects\Pages;

use App\Filament\Resources\ClassSubjects\ClassSubjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageClassSubjects extends ManageRecords
{
    protected static string $resource = ClassSubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
