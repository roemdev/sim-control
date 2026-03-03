<?php

namespace App\Filament\Resources\SolicitudSims\Pages;

use App\Filament\Resources\SolicitudSims\SolicitudSimResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSolicitudSims extends ListRecords
{
    protected static string $resource = SolicitudSimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
