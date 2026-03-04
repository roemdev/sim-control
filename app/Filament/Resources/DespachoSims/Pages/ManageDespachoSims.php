<?php

namespace App\Filament\Resources\DespachoSims\Pages;

use App\Filament\Resources\DespachoSims\DespachoSimResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDespachoSims extends ManageRecords
{
    protected static string $resource = DespachoSimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
