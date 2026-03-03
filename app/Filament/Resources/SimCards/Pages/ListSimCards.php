<?php

namespace App\Filament\Resources\SimCards\Pages;

use App\Filament\Resources\SimCards\SimCardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSimCards extends ListRecords
{
    protected static string $resource = SimCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
