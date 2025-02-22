<?php

namespace App\Filament\Resources\RecommandationResource\Pages;

use App\Filament\Resources\RecommandationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecommandations extends ListRecords
{
    protected static string $resource = RecommandationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
