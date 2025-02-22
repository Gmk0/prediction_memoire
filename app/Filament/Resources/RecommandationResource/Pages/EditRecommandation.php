<?php

namespace App\Filament\Resources\RecommandationResource\Pages;

use App\Filament\Resources\RecommandationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecommandation extends EditRecord
{
    protected static string $resource = RecommandationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
