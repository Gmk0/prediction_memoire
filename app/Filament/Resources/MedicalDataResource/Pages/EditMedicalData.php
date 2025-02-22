<?php

namespace App\Filament\Resources\MedicalDataResource\Pages;

use App\Filament\Resources\MedicalDataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicalData extends EditRecord
{
    protected static string $resource = MedicalDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
